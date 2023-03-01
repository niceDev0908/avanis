<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Artisan;

class SettingController extends Controller
{
    function __construct() {
        $this->middleware('permission:setting-list', ['only' => ['index', 'show']]);
    }
    public function index(){

    	$data = Setting::orderBy('id','desc')->get();

    	return view('admin.settings.index',compact('data'));
    }

    public function create_edit($id = "") { 
        
        if ($id > 0) {
        	$data = Setting::findOrFail($id);
        }
        return view('admin.settings.create_edit', compact('data'));
    }

    public function create_edit_action(Request $request){
    	$post_array = $name = $request->post();
        $id = (isset($post_array['id']) && $post_array['id'] > 0) ? $post_array['id'] : 0;

        if ($id > 0) {
            $data = Setting::find($id);
        }

        $data->setting_name = $post_array['setting_name'];
        $data->setting_slug = $post_array['setting_slug'];
        $data->setting_value = $post_array['setting_value'];
        
        $success = $data->save();
        
        if ($success) {
            $message = "Setting updated successfully.";
            $message_class = "success";
        } else {
            $message = "Error in updating Setting. Please try again.";
            $message_class = "failure";
        }

        return redirect()->route('admin.settings')->with($message_class, $message);
    }

}
