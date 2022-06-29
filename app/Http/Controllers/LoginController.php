<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function register()
    {
        return view('login_register.register');
    }

    public function checkRegister(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required|unique:users',
            'password' => 'required|min:5|max:12',
        ]);
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
        ]);
        if ($user) {
            return redirect()->back()->with('success', 'user is created');
        } else {
            return redirect()->back()->with('fail', 'some thing wrong');
        }
    }

    public function login()
    {
        return view('login_register.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:5|max:12',
        ]);

        $credentials = $request->only('password', 'phone');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/presence')
                ->with('success', 'Signed in');
        }
        Session::put('error','error login');
        return redirect()->back()->with('fail', 'Login details are not valid');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','you logged out');
    }

}
