<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Nette\Utils\DateTime;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('is_admin', 0)->get();
        return view('dashboard.admin_page.index_admin', compact('users'));
    }

    public function getAttendance($id)
    {
        $users = User::where('id', $id)->first();
        $attendanceday = [];
        $userdata = Attendance::where(['user_id' => $id, 'type' => 'presence'])->get();
        return view('dashboard.admin_page.attendance', compact('users', 'userdata', 'attendanceday'));
    }


    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function getCalender()
    {
        $data = Carbon::now();
//       $day= \request()->query('day');
//       $month= \request()->query('month');
//       $year= \request()->query('year');
//       $sday = Carbon::createFromFormat('d',Carbon::parse($day)->format('d') );
//       $smonth = Carbon::createFromFormat('m',Carbon::parse($month)->format('m') );
//       $syear = Carbon::createFromFormat('Y',Carbon::parse($day)->format('Y') );

//        $date_time = Carbon::create($syear,$sday,$smonth);
//        dd($date_time);
//        dd(\request()->all());
        $date = Carbon::createFromFormat('m/d/Y','')->addMonthsNoOverflow();
//        $newDate = $date->format('m/d/Y');

//        dd($newDate);

//        $lastMonth = $date->subMonth(); // August

        $month_name = $date->format('F');

//        $month = $lastMonth->month;

        $days = $date->month($date)->daysInMonth;

        $monthStartDate = $date->startOfMonth();

        $pickup_dates = [];
        for ($i = 1; $i <= $days; $i++) {
            $pickup_dates[] = $monthStartDate->toDateString();
            $monthStartDate = $monthStartDate->addDay();
        }
        $attends = Attendance::where(['user_id' => auth()->id(), 'type' => 'presence'])->get();
        foreach ($attends as $attend) {
            $history[] = $attend->history;
        }

        return view('dashboard.admin_page.calender', compact('history', 'month_name', 'pickup_dates', 'attends'));
    }

}

