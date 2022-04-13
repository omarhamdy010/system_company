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
        $presence_users = PageUser::all();
//        dd($presence_users);
        return view('/dashboard.user_page.index', compact('presence_users'));
    }

    public function store(User $user, Request $request)
    {
//dd($request->all());
        $pageuser = [
            'username' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'presence_time' => Carbon::now()->format('d-m-Y H:i:s'),
            'absence_time' => '-',
        ];

        PageUser::create($pageuser);
        return redirect()->back();
    }


    public function update(PageUser $pageUser, Request $request)
    {
        $pageUser->update([
            'absence_time' => Carbon::now()->format('d-m-Y H:i:s'),
        ]);
        return redirect()->back();
    }
}
