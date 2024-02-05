<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::latest()->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('Status', 1)->get();
        return view('admin.tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'towerId' => 'required',
            'subject' => 'required',
            'categoryId' => 'required',
            'message' => 'required|min:5',
        ]);

        try {
            DB::beginTransaction();
            $ticket = Ticket::create([
                'TowerId' => $request->towerId,
                'Number' => Ticket::max('Number') + 1,
                'UserId' => auth()->id(),
                'CategoryId' => $request->categoryId,
                'Subject' => $request->subject,
            ]);

            $fileName1 = "";
            $fileName2 = "";
            if ($request->file1) {
                $fileName1 = generateFileName($request->file1->getClientOriginalName());
                $request->file1->move(public_path(env('FILE_UPLOAD_PATH', false)), $fileName1);
            }
            if ($request->file2) {
                $fileName2 = generateFileName($request->file2->getClientOriginalName());
                $request->file2->move(public_path(env('FILE_UPLOAD_PATH', false)), $fileName2);
            }
            $message = Message::create([
                'UserId' => auth()->id(),
                'TicketId' => $ticket->Id,
                'Content' => nl2br($request->message),
                'File1' => $fileName1,
                'File2' => $fileName2,
            ]);
            $message->save();
            $ticket->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد سرویس تیکت وجود دارد.', $exception->getMessage())->persistent('باشه');
            return redirect()->back();
        }
        alert()->success(' تیکت با موفقیت ارسال شد.', 'موفق');
        return redirect()->route('admin.tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function message(Ticket $ticket)
    {
        return view('admin.tickets.message', compact('ticket'));
    }


    public function answer(Request $request)
    {
        $request->validate([
            'ticketId' => 'required',
            'message' => 'required|min:5',
        ]);

        try {
            DB::beginTransaction();
            $fileName1 = "";
            $fileName2 = "";
            if ($request->file1) {
                $fileName1 = generateFileName($request->file1->getClientOriginalName());
                $request->file1->move(public_path(env('FILE_UPLOAD_PATH', false)), $fileName1);
            }
            if ($request->file2) {
                $fileName2 = generateFileName($request->file2->getClientOriginalName());
                $request->file2->move(public_path(env('FILE_UPLOAD_PATH', false)), $fileName2);
            }
            $Ticket = Ticket::where('Id', $request->ticketId)->first();
            $Ticket->update([
                'Status' => 1
            ]);
            $Ticket->save();
            $message = Message::create([
                'UserId' => auth()->id(),
                'TicketId' => $request->ticketId,
                'Content' => nl2br($request->message),
                'File1' => $fileName1,
                'File2' => $fileName2,
            ]);
            $link = env('APP_URL_API') . '/tickets/message/' . $Ticket->Id;
            $text = "پیامی از طرف سامانه آپارتمانا به پروفایل کاربری شما ارسال شده، جهت بررسی به پورتال خود مراجمعه کنید.";
            $response = Http::get(env('APP_URL_API') . '/tokenservice/ticket_sms/' . env('APP_KEY_API') . '/' . $Ticket->user->Phone . '/' . $text);
            $message->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد سرویس تیکت وجود دارد.', $exception->getMessage())->persistent('باشه');
            return redirect()->back();
        }
        alert()->success(' تیکت با موفقیت ارسال شد.', 'موفق');
        return redirect()->back();
    }

    public function status(Request $request)
    {
        $request->validate([
            'ticketId' => 'required'
        ]);

        try {
            $Ticket = Ticket::where('Id', $request->ticketId)->first();
            if ($Ticket) {
                $Ticket->update([
                    'Status' => $request->status,
                ]);
                $Ticket->save();

            } else {
                return response(['errors' => 'خظا'], 422);
            }

            return response(['success' => 'true'], 200);

        } catch (\Exception $exception) {
            return response(['errors' => 'خظا'], 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        alert()->success('تیکت با موفقیت حذف شد.', 'موفق');
        return redirect()->route('admin.tickets.index');
    }
}
