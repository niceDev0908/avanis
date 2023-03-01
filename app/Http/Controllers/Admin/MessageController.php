<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendMessageMail;
use App\Message;
use App\User;
use Mail;
use Illuminate\Support\Facades\Auth;
use Session;

class MessageController extends Controller {

    public function index($user_id) {
        if (Auth::user()->intermediary_code != "") {
            $temp_arr = explode(",",Auth::user()->allows_intermediary_code);
            $intermediary_code = $temp_arr;             
            array_push($intermediary_code,Auth::user()->intermediary_code);

            $valid_users = User::whereIn('intermediary_code', $intermediary_code)->select('id')->get();
            if (isset($valid_users) && !empty($valid_users)) {
                $users_arr = array_column($valid_users->toArray(), 'id');
                if (!in_array($user_id, $users_arr)) {
                    return redirect()->route('admin.users')->with("danger", "You are not authorized to view this page.");
                }
            }
        }

        $messages = Message::with(['users_with_sender'])->orWhere('sender_id', $user_id)->orWhere('receiver_id', $user_id)->get();

        return view('admin.messages.send_view_message', compact('user_id', 'messages'));
    }

    public function send_message_thread(Request $request) {

        $message = $request->message;
        $send_message = Message::create([
                    'sender_id' => config('app.super_admin_id'),
                    'receiver_id' => $request->receiver_user_id,
                    'message' => $message
        ]);

        $user = User::where('id', $request->receiver_user_id)->first();
        $data = [
            'name' => config('app.name'),
            'message' => $user->toArray(),
            'body' => url('/') . '/messages/',
            'subject' => 'Message received from Avanis Support',
        ];
        #Mail::to($user->email, config('app.name'))->send(new SendMessageMail($data));

        return view('admin.messages.add_message_respond', compact('message'));
    }

    public function destroy($id) {
        $data = Message::find($id);
        $response = $data->delete();

        if ($response) {
            Session::flash('success', 'Message deleted successfully.');
            $success = 1;
        } else {
            Session::flash('danger', 'Error in deleting Message. Please try again.');
            $success = 0;
        }

        $return['success'] = $success;

        return response()->json($return);
    }

}
