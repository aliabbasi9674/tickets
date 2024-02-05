<?php

namespace App\Http\Controllers\Home;

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

        $TowerIds = listInfoTower(auth()->user()->Phone);
        $tickets = Ticket::where(function ($query) use ($TowerIds) {
            foreach ($TowerIds as $id) {
                $query->orWhere('TowerId', $id);
            }
        })->latest('created_at')->get();
        return view('home.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('Status', 1)->get();
        return view('home.tickets.create', compact('categories'));
    }

    public function message(Ticket $ticket)
    {
        $messages = $ticket->messages()->paginate(15);
        return view('home.tickets.message', compact('ticket', 'messages'));
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
            $text = "پیامی از طرف کاربر " . auth()->user()->Name . " به پروفایل مدیریت شما ارسال شده";
            if ($ticket->category->Name=="پشتیبانی"){
                $phone1="09155838813";
                $phone2="09158789604";
                Http::get(env('APP_URL_API') . '/tokenservice/ticket_sms/' . env('APP_KEY_API') . '/' . $phone1 . '/' . $text);
                Http::get(env('APP_URL_API') . '/tokenservice/ticket_sms/' . env('APP_KEY_API') . '/' . $phone2 . '/' . $text);
            }
            if ($ticket->category->Name=="فروش"){
                $phone1="09387972672";
                Http::get(env('APP_URL_API') . '/tokenservice/ticket_sms/' . env('APP_KEY_API') . '/' . $phone1 . '/' . $text);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد سرویس تیکت وجود دارد.', "خطا")->persistent('باشه');
            return redirect()->back();
        }
        alert()->success(' تیکت با موفقیت ارسال شد.', 'موفق');
        return redirect()->route('home.tickets.index');
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
                'Status' => 2
            ]);
            $Ticket->save();
            $lastMessage=Message::where('TicketId',$request->ticketId)->orderBy('created_at','DESC')->first();

            $message = Message::create([
                'UserId' => auth()->id(),
                'TicketId' => $request->ticketId,
                'Content' => nl2br($request->message),
                'File1' => $fileName1,
                'File2' => $fileName2,
            ]);
            $message->save();
            if ($lastMessage->user->Role==1){
                $text = "پیامی از طرف کاربر " . auth()->user()->Name . " به پروفایل مدیریت شما ارسال شده";
                $response = Http::get(env('APP_URL_API') . '/tokenservice/ticket_sms/' . env('APP_KEY_API') . '/' . $lastMessage->user->Phone . '/' . $text);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد سرویس تیکت وجود دارد.', "خطا")->persistent('باشه');
            return redirect()->back();
        }
        alert()->success(' تیکت با موفقیت ارسال شد.', 'موفق');
        return redirect()->back();
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


    public function status(Request $request)
    {
        $request->validate([
            'ticketId' => 'required'
        ]);

        try {
            $Ticket = Ticket::where('Id', $request->ticketId)->first();
            if ($Ticket) {
                $Ticket->update([
                    'Status' => 4,
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
    public function destroy($id)
    {
        //
    }
}
