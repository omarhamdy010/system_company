<?php

namespace App\Http\Controllers;

use App\Models\Password_resets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('login_register.password.forgetpassword');
    }


    public function submitForgetPasswordForm(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);
        $token = Str::random(64);

        $reset= DB::table('password_resets')->insert([
            'email' => $request->get('email'),
            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now(),
            'token' =>$token,
        ]);
        Mail::send('login_register.password.verify', ['token' =>$token], function ($message) use ($request) {
//            dd($message);
            $message->to($request->get('email'));
            $message->subject('Reset Password Notification');
            $message->from('hamdyomar065@gmail.com','DoNotReply');

        });
        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm()
    {
        return view('login_register.password.forgetPasswordLink');
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
//dd($request->all());
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
//                'token' => $request->token
            ])
            ->first();
//        dd($updatePassword);

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
//            dd('error');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
//        dd('success');

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
