<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Mail\SendMessageToAdminMail;
use Mail;

class MessageController extends Controller
{
	public function index(){

    	$messages = Message::with(['users_with_sender'])->orWhere('sender_id',Auth::user()->id)->orWhere('receiver_id',Auth::user()->id)->get();
		
		return view('messages.index',compact('messages'));
	}

	public function send_message(Request $request){
		$message = $request->message;
		$send_message = Message::create([
			'sender_id' => Auth::user()->id,
			'receiver_id' => $request->receiver_user_id,
			'message' => $message
		]);

		$user = User::where('id',$request->receiver_user_id)->first();
		$data = [
            'name' => config('app.name'),
            'message' => Auth::user()->first_name.' '.Auth::user()->last_name,
            'body' => url('/').'/admin/users/messages/'.Auth::user()->id,
            'subject' => 'Receive Message from'. Auth::user()->first_name.' '.Auth::user()->last_name,
        ];
		Mail::to($user->email, config('app.name'))->send(new SendMessageToAdminMail($data));

    	return view('messages.add_message_respond',compact('message'));
	}
}
