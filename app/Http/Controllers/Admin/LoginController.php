<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Mail\NotifyMail;
use Mail;
use Session;

class LoginController extends Controller {

    public function index(Request $request) {
        $err = $request->get('err');
        if (Auth::user()) {
            return redirect('admin/dashboard');
        }
        return view('admin.login', compact('err'));
    }

    public function adminLogin(Request $request) {
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('username' => $input['username'], 'password' => $input['password'], 'is_admin' => 1, 'status' => 1))) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin')->with('danger', 'Please enter correct username and password.');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('admin');
    }

    public function myprofile() {
        return view('admin.myprofile');
    }

    public function myprofile_action(Request $request) {
        $post_array = $name = $request->post();

        $data = User::find(Auth::user()->id);

        $data->first_name = $post_array['first_name'];
        $data->last_name = $post_array['last_name'];
        if (trim($post_array['password']) != "") {
            $data->password = Hash::make($post_array['password']);
        }

        $previous_image_name = $data->image;

        if ($request->file('image_file_name')) {
            $image = $request->file('image_file_name');
            $image_name = $image->getClientOriginalName();
            $modified_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $image_name);

            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/' . $previous_image_name))) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/' . $previous_image_name));
            }
            $image->move(public_path('uploads/users/' . Auth::user()->id . '/'), $modified_file_name);
            $data->image = $modified_file_name;
        } else {
            if (!empty($request->input_old_name)) {
                $data->image = $previous_image_name;
            } else {
                $data->image = '';
            }
        }

        $success = $data->save();

        if ($success) {
            $message = "Profile details updated successfully.";
            $message_class = "success";
        } else {
            $message = "Error in updating profile details. Please try again.";
            $message_class = "failure";
        }
        return redirect()->route('admin.myprofile')->with($message_class, $message);
    }

    public function deleteProfileImage($id) {
        $affected = User::where('id', '=', $id)->update(['image' => '']);
        unlink(public_path('uploads/users/' . $id . '/' . Auth::user()->image));
        if ($affected) {
            Session::flash('success', 'Image deleted successfully.');
            $success = 1;
        } else {
            Session::flash('danger', 'Error in deleting Image. Please try again.');
            $success = 0;
        }
        $return['success'] = $success;

        return response()->json($return);
    }

    public function adminForgotPassword(Request $request) {
        $email = $request->email;
        $user = User::where('email', '=', $email)->first();
        if (empty($user)) {
            return redirect()->route('admin', ['err' => 1])->with('danger', 'Your email is not associated with us.');
        }
        $token = str_random(60);

        $affected = User::where('email', '=', $email)->update(['remember_token' => $token]);
        $resetUrl = url('/') . '/admin/reset-password/' . $token . '/' . urlencode($user->email);
        $data = [
            'name' => config('app.name'),
            'message' => $resetUrl,
            'body' => $user->first_name.' '.$user->last_name,
            'subject' => 'Reset Password Url',
        ];
        #Mail::to($email, config('app.name'))->send(new NotifyMail($data));
        if (count(Mail::failures()) > 0) {
            return redirect()->route('admin')->with('danger', 'Failed to send password reset email, please try again.');
        } else {
            return redirect()->route('admin')->with('success', 'A reset link has been sent to your email address.');
        }
    }

    public function resetPassword($token, $email) {
        $exist = User::where('email', '=', $email)->where('remember_token', '=', $token)->first();
        if (empty($exist)) {
            return redirect()->route('admin')->with('danger', 'You are trying to access an invalid link.');
        }
        return view('admin.password.reset', compact('token', 'email'));
    }

    public function resetPasswordAction(Request $request) {
        $password = $request['password'];
        $email = $request['email'];
        $token = $request['token'];

        $exist = User::where('email', '=', $email)->where('remember_token', '=', $token)->first();
        if (empty($exist)) {
            return redirect()->route('admin')->with('danger', 'Something went wrong. Please try again');
        }

        $update = User::where('email', $email)->update(['password' => Hash::make($password), 'remember_token' => '']);

        return redirect()->route('admin')->with('success', 'Please login with new password.');
    }

}
