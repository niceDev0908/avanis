<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserLog;
use App\Message;
use App\UserAction;
use App\UserActionDocuments;
use File;
use Session;

class ProfileController extends Controller
{
    public function changePasswordView() {
        return view('auth.change-password');
    }

    public function changePasswordAction(Request $request) {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::user()->password)) {

            User::find(auth()->user()->id)->update(['password' => Hash::make($data['new_password'])]);
            $message = "Password updated successfully.";
            $message_class = "success";
        } else {
            $message = "Error in updating password. Please try again.";
            $message_class = "danger";
        }
        return redirect()->route('change-password')->with($message_class, $message);
    }

    public function manage_profile() {
        $data = User::where('id', '=', auth()->user()->id)->first();
        return view('manage-profile', compact('data'));
    }

    public function manage_profile_action(Request $request) {
        $id = auth()->user()->id;

        $user = User::find($id);

        $old_user_name = $user->username;
        $previous_file_name = $user->image;

        $username = strtolower($request->first_name . '-' . $request->last_name);
        $allusers = User::where('username', '=', $username)->first();

        if (empty($allusers)) {
            $user->username = $username;
        } else {
            if ($request->first_name == $user->first_name && $request->last_name == $user->last_name) {
                $user->username = $old_user_name;
            } else {
                $user->username = $username . $id;
            }
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->company = $request->company;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->town = $request->town;
        $user->county = $request->county;
        $user->postcode = $request->postcode;
        $user->country = $request->country;
        $user->phone_number = $request->phone_number;
        $success = $user->save();

        if ($success) {
            $message = "Profile updated successfully.";
            $message_class = "success";
        } else {
            $message = "Error in updating Profile. Please try again.";
            $message_class = "danger";
        }
        return redirect()->route('manage-profile')->with('success', 'Profile updated successfully.');
    }

    public function delete_account() {
        return view('delete-account');
    }

    public function delete_account_action($id) {

        $data = User::find($id);
        $user_logs = UserLog::where('user_id', '=', $id)->forceDelete();
        $messages = Message::where('sender_id', '=', $id)->orWhere('receiver_id', '=', $id)->forceDelete();
        $user_actions = UserAction::where('user_id','=',$id)->forceDelete();
    
        File::deleteDirectory(public_path('uploads/users/' . $id));

        $response = $data->forceDelete();
        if ($response) {
            $success = 1;
        } else {
            $success = 0;
        }

        $return['success'] = $success;
        Session::flush();
        return response()->json($return);
    }
}
