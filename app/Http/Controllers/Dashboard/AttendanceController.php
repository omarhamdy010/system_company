<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function index()
    {
//        if(Session::has('login_id')){
            $user = User::where('id',Session::get('login_id'))->first();
            $attendance = $user->is_attendance;
//        }
        return view('/dashboard.user_page.index', compact('attendance'));
    }

    public function store()
    {
        $attendance = User::where('id',Session::get('login_id'))->first()->is_attendance;
        if ($attendance == false) {
            $attendance_user = ['user_id' => User::where('id',Session::get('login_id'))->first()->id, 'type' => 'presence', 'time' => Carbon::now(), 'history' => date("Y-m-d", time())];
            Attendance::create($attendance_user);
        }

        if ($attendance == true) {
            Attendance::updateOrCreate(['user_id' => User::where('id',Session::get('login_id'))->first()->id, 'type' => 'leave', 'history' => date("Y-m-d", time())], ['time' => Carbon::now(),]);
        }
        return response()->json(['success' => true, 'message' => 'Data inserted successfully']);
    }

    public function calender()
    {
        $presence_users = Attendance::where('user_id', User::where('id',Session::get('login_id'))->first()->id)->orderBy('history', 'asc')->get();
        return view('dashboard.user_page.calender', compact('presence_users'));
    }
}
