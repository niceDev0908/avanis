<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Mail\ResetNotifyMail;
use App\User;
use Mail;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    //use SendsPasswordResetEmails;
    public function index(){
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request){
        $email = $request->forgot_email;
        $user = User::where('email', '=', $email)->first();
        if (empty($user)) {
            return redirect()->route('forgot-password')->with('danger', 'Your email is not associated with us.');
        }
        $token = str_random(60);

        $affected = User::where('email', '=', $email)->update(['remember_token' => $token]);
        $resetUrl = url('/') . '/reset-passwords/' . $token . '/' . urlencode($user->email);
        $data = [
            'name' => config('app.name'),
            'message' => $resetUrl,
            'body' => $user->first_name.' '.$user->last_name,
            'subject' => 'Reset Password Url',
        ];

        #Mail::to($email, config('app.name'))->send(new ResetNotifyMail($data));
        if (count(Mail::failures()) > 0) {
            return redirect()->route('forgot-password')->with('danger', 'Failed to send password reset email, please try again.');
        } else {
            return redirect()->route('forgot-password')->with('success', 'A reset link has been sent to your email address.');
        }
    }
}
