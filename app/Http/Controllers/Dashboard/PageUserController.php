<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PageUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PageUserController extends Controller
{
    public function index()
    {
        return view('/dashboard.user_page.index');
    }

    public function store(User $user, Request $request)
    {
        $page = PageUser::where(['type' => 'presence', 'day' => \Illuminate\Support\Carbon::today()->format('l'), 'user_id' => auth()->user()->id])->latest()->first();
        if (is_null($page)) {
            $pageuser = [
                'user_id' => auth()->user()->id,
                'type' => 'presence',
                'time' => '-',
                'day' => '-',
            ];

            $pag = PageUser::create($pageuser);
            $pageuser = [
                'time' => $pag->created_at,
                'day' => \Illuminate\Support\Carbon::today()->format('l'),
            ];


            $pag->update($pageuser);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        }
    }


    public function save(Request $request)
    {
        $page = PageUser::where(['type' => 'absence', 'day' => \Illuminate\Support\Carbon::today()->format('l'), 'user_id' => auth()->user()->id])->latest()->first();
        if (is_null($page)) {
            $pageuser = [
                'user_id' => auth()->user()->id,
                'type' => 'absence',
                'time' => '-',
                'day' => '-',
            ];
            $pag = PageUser::create($pageuser);
            $pageuser = [
                'time' => $pag->updated_at,
                'day' => \Illuminate\Support\Carbon::today()->format('l'),
            ];


            $pag->update($pageuser);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        } else {

            $pageuser = [
                'time' => $page->updated_at,
                'day' => \Illuminate\Support\Carbon::today()->format('l'),
            ];


            $page->update($pageuser);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]);
        }
    }

    public function calender()
    {
        $presence_users = PageUser::where('user_id', auth()->user()->id)->get();

        return view('dashboard.user_page.calender', compact('presence_users'));
    }


    public function calc()
    {
        $pageUser = PageUser::where('user_id', auth()->user()->id)->first();
        $now = Carbon::now();
        $created_at = Carbon::parse($pageUser['created_at']);
//        $diffHuman = $created_at->diffForHumans($now);  // 3 Months ago
//        $diffHours = $created_at->diffInHours($now);  // 3
        $diffMinutes = $created_at->diffInMinutes($now);  // 180
        return $diffMinutes;
    }

}
