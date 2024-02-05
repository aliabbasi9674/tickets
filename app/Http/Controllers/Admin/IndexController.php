<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $last30Days = $this->previous_dates(30);
        $countTickets=Ticket::count();
        $countTicketsP=Ticket::where('Status',0)->count();
        $countTicketsC=Ticket::where('Status',3)->count();
        $countTicketsR=Ticket::where('Status',4)->count();


        $ret['count_tickets_month'] = [];
        $ret['count_ticketsP_month'] = [];
        $ret['count_ticketsC_month'] = [];
        $ret['count_ticketsR_month'] = [];
        $ret['count_user_month'] = [];
        $ret['date'] = [];
        foreach ($last30Days as $date) {
            $ret['count_tickets_month'][]  += Ticket::whereDate('created_at', $date)->count();
            $ret['count_ticketsP_month'][]  += Ticket::where('Status',0)->whereDate('created_at', $date)->count();
            $ret['count_ticketsC_month'][]  += Ticket::where('Status',3)->whereDate('created_at', $date)->count();
            $ret['count_ticketsR_month'][]  += Ticket::where('Status',4)->whereDate('created_at', $date)->count();
            $ret['count_user_month'][]  += User::whereDate('created_at', $date)->count();
            $ret['date'][] =  Verta::instance($date)->format('l d F Y');
        }
        return view('admin.main',compact('countTickets','countTicketsP','countTicketsC','countTicketsR','ret'));
    }



    function previous_dates(int $days)
    {
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays($days);

        return CarbonInterval::day()->toPeriod($startDate, $endDate);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
