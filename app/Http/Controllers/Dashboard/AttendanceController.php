<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = auth()->user()->is_attendance;
        return view('/dashboard.user_page.index', compact('attendance'));
    }

    public function store()
    {
        $attendance = auth()->user()->is_attendance;
        $datetime = Carbon::now()->toDateTimeString();
        $cur_time = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('h:i:s A');

//      dump($cur_time);
//        $dt= Carbon::createFromFormat('H:i:s',$cur_time)->format('H:i:s A');
//        dd($dt);

        if ($attendance == false) {
            $attendance_user = ['user_id' => auth()->user()->id, 'type' => 'presence', 'time' => $cur_time , 'history' => date("Y-m-d", time())];
            Attendance::create($attendance_user);
        }

        if ($attendance == true) {
            Attendance::updateOrCreate(['user_id' => auth()->user()->id, 'type' => 'leave', 'history' => date("Y-m-d", time())], ['time' => $cur_time]);
        }
        return response()->json(['success' => true, 'message' => 'Data inserted successfully']);
    }

    public function calender()
    {
        $presence_users = Attendance::where('user_id', auth()->user()->id)->orderBy('history', 'asc')->get();
        return view('dashboard.user_page.calender', compact('presence_users'));
    }
}
