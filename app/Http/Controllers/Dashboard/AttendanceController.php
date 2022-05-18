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
        $leave = auth()->user()->is_leave;

        if ($attendance == false) {
            $attendance_user = [
                'user_id' => auth()->user()->id,
                'type' => 'presence',
                'time' => Carbon::now(),
                'history' => date("Y-m-d", time())
            ];

            Attendance::create($attendance_user);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        } elseif ($leave == false) {
            $attendance_user = [
                'user_id' => auth()->user()->id,
                'type' => 'leave',
                'time' => Carbon::now(),
                'history' => date("Y-m-d", time())
            ];

            Attendance::create($attendance_user);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        } else {
            $update_leave = Attendance::where(['type' => 'leave',
                'history' => Carbon::now()->format('Y-m-d')
            ])->first();
            $attendance_user = [
                'time' => Carbon::now(),
                'history' => date("Y-m-d", time()),
            ];

            $update_leave->update($attendance_user);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        }
    }

    public function calender()
    {
        $presence_users = Attendance::where('user_id', auth()->user()->id)->orderBy('history', 'asc')->get();

        return view('dashboard.user_page.calender', compact('presence_users'));
    }

}
