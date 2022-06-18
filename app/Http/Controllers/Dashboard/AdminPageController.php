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

    public function getCalender(Request $request, $id)
    {
        $current_month = $request->date ? Carbon::parse($request->date) : Carbon::now();
        $users = User::where(['is_admin' => 0, 'status' => 1])->get();
        $month_name = $current_month->format('F');
        $month = $current_month->month;
        $days = $current_month->month($month)->daysInMonth;
        $monthStartDate = $current_month->startOfMonth();
        $day_week_start = [];

        $weekend = ['Friday', 'Saturday'];

        $daynames = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        foreach ($daynames as $key => $day) {
            if ($monthStartDate->format('l') == $day) {
                break;
            }
            $day_week_start[] = $daynames[$key];
            unset($daynames[$key]);
        }
        $daysfirstweek = array_values($daynames);

        $attends = Attendance::where(['user_id' => $id])->get();

        $daynumberofattend = 0;
        $absence = 0;
        $history = [];
        foreach ($attends as $attend) {
            $history[] = $attend->history;
        }
        $time_diff_hours = 0;
        $time_diff_minutes = 0;
        $pickup_dates = [];
        for ($i = 1; $i <= $days; $i++) {
            $pickup_dates[] = $monthStartDate->toDateString();
            if (in_array($pickup_dates[$i - 1], $history)) {
                in_array(Carbon::parse($pickup_dates[$i - 1])->format('l'), $weekend) ? '' : $daynumberofattend = $daynumberofattend + 1;
            } else {
                in_array(Carbon::parse($pickup_dates[$i - 1])->format('l'), $weekend) ? '' : $absence = $absence + 1;
            }

            $daysmustattend = $absence + $daynumberofattend;

            $avarge_work_in_month = 8 * $daysmustattend;

            foreach ($attends as $attend) {
                if ($attend->history == $pickup_dates[$i - 1]) {
                    $att1 = $attend->where(['history' => $pickup_dates[$i - 1], 'type' => 'presence'])->first();
                    $att2 = $attend->where(['history' => $pickup_dates[$i - 1], 'type' => 'leave'])->first();
                    if ($att1 != null && $att2 != null) {
                        $time_diff_hours += \Illuminate\Support\Carbon::parse($att1->time)->diff((\Illuminate\Support\Carbon::parse($att2->time)))->format('%h');
                        $time_diff_minutes += \Illuminate\Support\Carbon::parse($att1->time)->diff((\Illuminate\Support\Carbon::parse($att2->time)))->format('%i');
                    }
                }
                break;
            }
            $monthStartDate = $monthStartDate->addDay();
        }
        return view('dashboard.admin_page.calender', compact('avarge_work_in_month', 'month_name', 'pickup_dates', 'attends', 'users', 'current_month', 'daynames', 'daysfirstweek', 'history', 'day_week_start', 'daynumberofattend', 'absence', 'daysmustattend', 'time_diff_hours', 'time_diff_minutes', 'id'));
    }

}

