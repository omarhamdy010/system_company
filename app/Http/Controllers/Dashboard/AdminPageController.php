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

    public function getCalender(Request $request)
    {
        $current_month = $request->date ? Carbon::parse($request->date):Carbon::now();
        $dayOfTheWeek = $current_month->dayOfWeek;

        $month_name = $current_month->format('F');
        $month = $current_month->month;
        $days = $current_month->month($month)->daysInMonth;
        $monthStartDate = $current_month->startOfMonth();

//        $monthStartDate->format('l');//name of the first day of month

        $daynames = ['Saturday','Sunday','Monday', 'Tuesday','Wednesday','Thursday','Friday'];
        foreach ($daynames as $key=>$day){
            if($monthStartDate->format('l')==$day){
                break;}
            array_push($daynames , $day);
            unset($daynames[$key]);}
        $daysfirstweek=array_values($daynames);

        $pickup_dates = [];
        for ($i = 1; $i <= $days; $i++) {
            $pickup_dates[] = $monthStartDate->toDateString();
            $monthStartDate = $monthStartDate->addDay();
        }
        $attends = Attendance::where(['user_id'=>auth()->id(),'type'=>'presence'])->get();


        return view('dashboard.admin_page.calender', compact('month_name', 'pickup_dates','attends','current_month','daynames','daysfirstweek'));
    }

}

