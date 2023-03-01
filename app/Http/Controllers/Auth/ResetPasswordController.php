<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function resetPassword($token, $email) {
        $exist = User::where('email', '=', $email)->where('remember_token', '=', $token)->first();
        if (empty($exist)) {
            return redirect()->route('forgot-password')->with('danger', 'You are trying to access an invalid link.');
        }
        return view('auth.reset', compact('token', 'email'));
    }

    public function resetPasswordAction(Request $request) {
        $password = $request['password_reset'];
        $email = $request['reset_email'];
        $token = $request['reset_token'];

        $exist = User::where('email', '=', $email)->where('remember_token', '=', $token)->first();
        if (empty($exist)) {
            return redirect()->route('reset-passwords',['email'=>$email , 'token'=>$token])->with('danger', 'Something went wrong. Please try again');
        }
        $update = User::where('email', $email)->update(['password' => Hash::make($password), 'remember_token' => '']);
        return redirect()->route('login')->with('success', 'Please login with new password.');
    }
}
