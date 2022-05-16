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

        if ($attendance==false) {
            $pageuser = [
                'user_id' => auth()->user()->id,
                'type' => 'presence',
                'time' => '-',
                'history' => '-'
            ];

            $pag = Attendance::create($pageuser);
            $pageuser = [
                'time' => $pag->created_at,
                'history' => Carbon::now()->format('Y-m-d'),
            ];


            $pag->update($pageuser);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        }elseif ($leave == false){
            $pageuser = [
                'user_id' => auth()->user()->id,
                'type' => 'leave',
                'time' => '-',
                'history' => '-'
            ];
            $pag = Attendance::create($pageuser);
            $pageuser = [
                'time' => $pag->updated_at,
                'history' => Carbon::now()->format('Y-m-d'),
            ];

            $pag->update($pageuser);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        }else{
           $update_leave = Attendance::where(['type' => 'leave',
               'history'=> Carbon::now()->format('Y-m-d')
           ])->first();
            $pageuser = [
                'time' => $update_leave->updated_at,
                'history' => Carbon::now()->format('Y-m-d'),
            ];

            $update_leave->update($pageuser);

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


    public function calc()
    {
        $pageUser = Attendance::where('user_id', auth()->user()->id)->first();
        $now = Carbon::now();
        $created_at = Carbon::parse($pageUser['created_at']);
        $diffMinutes = $created_at->diffInMinutes($now);  // 180
        return $diffMinutes;
    }

}
