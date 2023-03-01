<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewUserRegisterNotify;
use App\User;
use DB;
use Mail;

class RegisterController extends Controller
{
    use RegistersUsers;
    
    public function __construct(){
        $this->middleware('guest');
        
    }
    public function register_store(Request $request){
        $mailData = $request->all();
        $token = str_random(60);
        $username = strtolower($request->first_name.'-'.$request->last_name);
        $allusers = User::where('username','=',$username)->first();
 
        $user = new User;
        $user->status = 2;
        $user->is_admin = 0;
        $user->password = Hash::make($request->reg_password);
        $user->company = $request->company;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->intermediary_code = $request->intermediary_code;
        $user->product_type = $request->product_type;
        $user->username = '';
        $user->email = $request->reg_email;
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->town = $request->town;
        $user->county = $request->county;
        $user->postcode = $request->postcode;
        $user->country = $request->country;
        $user->phone_number = $request->phone_number;
        $user->save();

        $id = DB::getPdo()->lastInsertId();
        $user->assignRole('User');

        if(empty($allusers)){
            User::whereId($id)->update(['username'=>$username]);
        }else{
            User::whereId($id)->update(['username'=>$username.$id]);
        }

        $verify_url = url('/') . '/admin/users/edit/' . $id;
        $data = [
            'name' => config('app.name'),
            'message' => $mailData,
            'body' => $verify_url,
            'subject' => 'New user registered via '.config('app.name'),
        ];

        Mail::to(config('app.from_mail_address'), config('app.name'))->send(new NewUserRegisterNotify($data));

        $message = 'You have registered successfully. Your account is now under review. Once your account has been approved you will receive confirmation by email.';
        $message_class = "success";   

        return redirect()->route('register')->with($message_class,$message);     
    }

}
