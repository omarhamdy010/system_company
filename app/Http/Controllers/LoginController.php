<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login_register.login');
    }

    public function checkRegister(Request $request){

        $request->validate([
        'name'=>'required',
        'email'=>'required|unique:users|email',
        'phone'=>'required|unique:users',
        'password'=>'required|min:5|max:12',
        ]);
    }
    public function checkLogin(Request $request){
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/presence')
                ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function register(){
        return view('login_register.register');
    }
}
