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
        $page = PageUser::where(['type' => 'presence', 'day' => \Illuminate\Support\Carbon::today()->
        format('l'), 'user_id' => auth()->user()->id])->
        where('history', '=', Carbon::now()->format('Y-m-d'))->latest()->first();

        return view('/dashboard.user_page.index', compact('page'));
    }

    public function store(User $user, Request $request)
    {
        $page = PageUser::where(['type' => 'presence', 'day' => \Illuminate\Support\Carbon::today()->
        format('l'), 'user_id' => auth()->user()->id])->
        where('history', '=', Carbon::now()->format('Y-m-d'))->latest()->first();
        if (is_null($page)) {
            $pageuser = [
                'user_id' => auth()->user()->id,
                'type' => 'presence',
                'time' => '-',
                'day' => '-',
                'history' => '-'
            ];

            $pag = PageUser::create($pageuser);
            $pageuser = [
                'time' => $pag->created_at,
                'day' => \Illuminate\Support\Carbon::today()->format('l'),
                'history' => Carbon::now()->format('Y-m-d'),
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
        $page = PageUser::where(['type' => 'leave', 'day' => \Illuminate\Support\Carbon::today()->
        format('l'), 'user_id' => auth()->user()->id])->
        where('history', '=', Carbon::now()->format('Y-m-d'))->latest()->first();
        if (is_null($page)) {
            $pageuser = [
                'user_id' => auth()->user()->id,
                'type' => 'leave',
                'time' => '-',
                'day' => '-',
                'history' => '-'
            ];
            $pag = PageUser::create($pageuser);
            $pageuser = [
                'time' => $pag->updated_at,
                'day' => \Illuminate\Support\Carbon::today()->format('l'),
                'history' => Carbon::now()->format('Y-m-d'),
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
                'history' => Carbon::now()->format('Y-m-d'),
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
        $presence_users = PageUser::where('user_id', auth()->user()->id)->orderBy('history', 'asc')->get();

        return view('dashboard.user_page.calender', compact('presence_users'));
    }


    public function calc()
    {
        $pageUser = PageUser::where('user_id', auth()->user()->id)->first();
        $now = Carbon::now();
        $created_at = Carbon::parse($pageUser['created_at']);
        $diffMinutes = $created_at->diffInMinutes($now);  // 180
        return $diffMinutes;
    }

}
