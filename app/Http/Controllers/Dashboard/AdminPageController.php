<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public static function months($futureM)
    {
//        $now = Carbon::now();
//        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
//        $end = (new DateTime(($now->addMonths($futureM))->format('Y-m-d')))->modify('first day of next month');
//        $interval = \DateInterval::createFromDateString('1 month');
//        $period = new \DatePeriod($start, $interval, $end);
//        $months = array();
//        foreach ($period as $dt) {
//            array_push($months, array('month' => $dt->format("F/Y"), 'days' ));
//        }
//        return $months;
    }

    public function getCalender()
    {
        $current_month = Carbon::now();
        $month_name = $current_month->format('F');
        $month = $current_month->month;
        $days = Carbon::now()->month($month)->daysInMonth;
        $monthStartDate = Carbon::now()->startOfMonth();
        $pickup_dates = [];
        for ($i = 1; $i <= $days; $i++) {
            $pickup_dates[] = $monthStartDate->toDateString();
            $monthStartDate = $monthStartDate->addDay();
        }
        $attends = Attendance::where(['user_id'=>auth()->id(),'type'=>'presence'])->get();

        return view('dashboard.admin_page.calender', compact('month_name', 'pickup_dates','attends'));
    }

}

