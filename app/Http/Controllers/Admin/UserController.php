<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserRecipient;
use App\UserReference;
use App\Asset;
use App\AssetLog;
use App\PMCModule;
use App\Receivables;
use App\UserAction;
use App\UserActionDocument;
use App\UserActionDocumentRequested;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Mail\AccountActiveMail;
use DB;
use Hash;
use Session;
use Mail;
use File;
use ZipArchive;
// use Madzipper;

class UserController extends Controller {

    function __construct() {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (Auth::user()->intermediary_code != '') {
            $temp_arr = explode(",",Auth::user()->allows_intermediary_code);
            $intermediary_code = $temp_arr;             
            array_push($intermediary_code,Auth::user()->intermediary_code);
            $data = User::role('User')->orderBy('id', 'DESC')->whereIn('intermediary_code', $intermediary_code)->get();
        } else {
            $data = User::orderBy('id', 'DESC')->get();
        }
        return view('admin.users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create_edit($id = "") {
        $userRole = collect();
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'name')->all();
        $user_assets = [];
        $user_recipients = [];
        $user_pmc = [];
        if ($id == "") {
            $data = new User;
        } else if ($id > 0) {
            $data = User::where('id', '=', $id)->first();
            $userRole = $data->roles->pluck('name', 'name')->all();
            
            $user_recipients = UserRecipient::where('user_id', $id)->orderBy('id', 'ASC')->get();
            $user_assets = Asset::whereUserId($id)->withTrashed()->get();
            $user_pmc = PMCModule::whereUserId($id)->get();
        }
        return view('admin.users.create_edit', compact('roles', 'data', 'userRole', 'user_recipients','user_assets', 'user_pmc'));
    }

    public function view_users_assets_log($id) {
        $asset_logs = AssetLog::whereAssetId($id)->orderBy('id','desc')->get();
        return view('admin.users.add_asset_logs', compact('asset_logs'));
    }

    public function create_edit_action(Request $request) {
        $post_array = $name = $request->post();
        $id = (isset($post_array['id']) && $post_array['id'] > 0) ? $post_array['id'] : 0;

        if ($id == 0) {
            $data = new User;
            $previous_file_name = "";
            $old_user_name = '';
            $old_status = '';
        } else if ($id > 0) {
            $data = User::find($id);
            $previous_file_name = $data->image;
            $old_user_name = $data->username;
            $old_status = $post_array['old_status'];
        }

        if ($post_array['roles'] == 'Admin' || $post_array['roles'] == 'Super Admin' || $post_array['roles'] == 'Intermediary') {
            $admin_status = 1;
        } else {
            $admin_status = 0;
        }

        $username = strtolower($post_array['f_name'] . '-' . $post_array['l_name']);
        $allusers = User::where('username', '=', $username)->first();

        if ($old_user_name) {
            $data->username = $old_user_name;
        } else {
            $data->username = '';
        }

        if (trim($post_array['password']) != "") {
            $data->password = Hash::make($post_array['password']);
        }
        $data->first_name = $post_array['f_name'];
        $data->last_name = $post_array['l_name'];
        $data->company = $post_array['company'];
        $data->email = $post_array['email'];
        $data->is_admin = $admin_status;
        $data->address = $post_array['address'];
        $data->address2 = $post_array['address2'];
        $data->town = $post_array['town'];
        $data->county = $post_array['county'];
        $data->postcode = $post_array['postcode'];
        $data->country = $post_array['country'];
        $data->phone_number = $post_array['phone_number'];
        $data->intermediary_code = $post_array['intermediary_code'];
        $data->allows_intermediary_code = $post_array['allows_intermediary_code'];
        $data->receivables = (isset($post_array['receivables']) && $post_array['receivables'] != "") ? $post_array['receivables'] : 0;
        $data->planning_fee = $post_array['planning_fee'];
        $data->avanis_fee = $post_array['avanis_fee'];
        $data->product_type = (isset($post_array['product_type']) && $post_array['product_type'] != "") ? $post_array['product_type'] : NULL;
        $data->business_type = (isset($post_array['business_type']) && $post_array['business_type'] != "" ) ? $post_array['business_type'] : NULL;

        if((isset($post_array['date_of_rsa']) && $post_array['date_of_rsa'] != "")) {
            $data->date_of_rsa = $post_array['date_of_rsa'];
        }
        if((isset($post_array['date_of_fsa']) && $post_array['date_of_fsa'] != "")) {
            $data->date_of_fsa = $post_array['date_of_fsa'];
        }
        $data->user_notes = trim($post_array['user_notes']);
        if (isset($post_array['status'])) {
            $data->status = $post_array['status'];
        }

        $success = $data->save();
        $image_id = DB::getPdo()->lastInsertId();
        //$data->assignRole($post_array['roles']);
        $data->syncRoles($post_array['roles']);

        if (empty($allusers)) {
            User::whereId($image_id)->update(['username' => $username]);
        } else {
            User::whereId($image_id)->update(['username' => $username . $image_id]);
        }

        if ($old_status == 2) {
            $verify_url = url('/') . '/login';
            $active_data = [
                'name' => config('app.name'),
                'body' => $verify_url,
                'subject' => 'Membership activation email',
                'message' => $data->first_name . ' ' . $data->last_name,
            ];
            #Mail::to($data->email, config('app.name'))->send(new AccountActiveMail($active_data));
        }

        if ($success) {
            if ($id == 0) {
                $message = "User added successfully.";
            } else if ($id > 0) {
                $message = "User updated successfully.";
            }
            $message_class = "success";
        } else {
            if ($id == 0) {
                $message = "Error in adding User. Please try again.";
            } else if ($id > 0) {
                $message = "Error in updating User. Please try again.";
            }
            $message_class = "failure";
        }
        return redirect()->route('admin.users')->with($message_class, $message);
    }

    public function create_edit_recipients_action(Request $request) {
        $post_array = $name = $request->post();
        
        $deletedRows = UserRecipient::where('user_id', $post_array['id'])->delete();
        
        for ($i = 0; $i < count($post_array['recipient_name']); $i++) {
            if($i == 0) {
                continue;
            }
            
            $data_ins = new UserRecipient;
            $data_ins->user_id = $post_array['id'];
            $data_ins->recipient_name = $post_array['recipient_name'][$i];
            $data_ins->planning_fee = $post_array['planning_fee'][$i];
            $data_ins->avanis_fee = $post_array['avanis_fee'][$i];
            $data_ins->save();
            
        }
        
        return redirect()->route('admin.users')->with("success", "Recipients updated successfully");
    }

    public function destroy($id) {
        $data = User::find($id);
        $response = $data->delete();

        if ($response) {
            Session::flash('success', 'User deleted successfully.');
            $success = 1;
        } else {
            Session::flash('danger', 'Error in deleting User. Please try again.');
            $success = 0;
        }

        $return['success'] = $success;

        return response()->json($return);
    }

    public function update_selected_records_status(Request $request) {
        $post_array = $request->post();
        if ($post_array['action'] == "Active") {
            $status = 1;
        } else {
            $status = 0;
        }
        $response = User::whereIn('id', $post_array['ids'])
                ->update(['status' => $status]);

        if ($response) {
            $success = 1;
        } else {
            $success = 0;
        }

        $return['success'] = $success;

        return response()->json($return);
    }

    public function delete_selected_records(Request $request) {
        $post_array = $request->post();

        $response = User::whereIn('id', $post_array['ids'])
                ->delete();

        if ($response) {
            Session::flash('success', 'Selected record(s) deleted successfully.');
            $success = 1;
        } else {
            Session::flash('danger', 'Error in deleting selected record(s). Please try again.');
            $success = 0;
        }

        $return['success'] = $success;

        return response()->json($return);
    }
    
    public function download_user_documents($id) {
        $other_actions_count = \App\UserAction::where('user_id', $id)->where('receivable_id', 0)->count();
        $receivables = Receivables::with('user_action')->where('user_id', $id)->get();
        $dir_temp = public_path(). "/uploads/users/".$id."/";
        $annual_compliance_dir = public_path()."/uploads/users/".$id."/annual_compliance/";
        mkdir($dir_temp . "temp", 0777);
        $download_count = 0;

        if(File::isDirectory($annual_compliance_dir)) {
            $scan_annual_compliance = scandir($annual_compliance_dir);
            $dir_temp_annual = public_path(). "/uploads/users/".$id."/temp/";
            foreach($scan_annual_compliance as $key => $val) {
                if (!is_dir($dir_temp_annual . "annual_compliance")) {
                    mkdir($dir_temp_annual . "annual_compliance", 0777);
                }
                if (!is_dir($dir_temp_annual . "annual_compliance/" . $val)) {
                    copy($annual_compliance_dir . $val, $dir_temp_annual . "annual_compliance/" . $val);
                }
            }
            $download_count++;
        }

        if($other_actions_count > 0) {
            if (!is_dir($dir_temp . "temp/" . 'Other' . "/")) {
                mkdir($dir_temp . "temp/" . 'Other' . "/", 0777);
            }
            $other_actions = UserAction::with(['user_action_documents'])->where('user_id', $id)->where('receivable_id', 0)->where('status', 1)->orderBy('id', 'desc')->get();

            // Main Directory
            $other_dir = public_path(). "/uploads/users/".$id."/temp/Other/";
            foreach($other_actions as $o_action) { 
                if(!is_dir($other_dir. $o_action->title."/")) {
                    mkdir($other_dir. $o_action->title."/", 0777);
                }

                // Actions
                $other_action_files = UserActionDocument::where('user_action_id', $o_action->id)->orderBy('id', 'desc')->get();
                $other_action_dir = public_path(). "/uploads/users/".$id."/temp/Other/".$o_action->title."/";

                // Action Files
                foreach($other_action_files as $o_file) {

                    if(!is_dir($other_action_dir.$o_file->document_title."/")) {
                        mkdir($other_action_dir.$o_file->document_title."/", 0777);
                    }

                    // Documents
                    $other_scan_dir_path = public_path(). "/uploads/users/".$id."/actions/" .$o_action->id. "/". $o_file->id.'/';
                    if(File::isDirectory($other_scan_dir_path)) { 
                        $c = scandir($other_scan_dir_path);
                        if(count($c) > 0) {
                            foreach($c as $key1 => $val1) {
                                if ($val1 != "." && $val1 != "..") { 
                                    copy($other_scan_dir_path . $val1, $other_action_dir.$o_file->document_title.'/'.$val1);
                                }
                            }
                        }
                    }
                }
            }
            $download_count++;
        }

        foreach($receivables as $receivable) {
            // Main Directory
            $receivable_name = '£ '.$receivable->amount.' - '.getFormatedDate($receivable->date);
            if (!is_dir($dir_temp . "temp/" . $receivable_name . "/")) {
                mkdir($dir_temp . "temp/" . $receivable_name . "/", 0777);
            }

            
            // Actions
            $actions = UserAction::with(['user_action_documents'])->where('user_id', $id)->where('receivable_id', $receivable->id)->where('status', 1)->orderBy('id', 'desc')->get();
            $action_dir = public_path(). "/uploads/users/".$id."/temp/".$receivable_name."/";
            foreach($actions as $action) {
                if (!is_dir($action_dir.$action->title."/")) {
                    mkdir($action_dir.$action->title."/", 0777);
                }

                //action_files
                $action_files = UserActionDocument::where('user_action_id', $action->id)->orderBy('id', 'desc')->get();
                $action_file_dir = public_path(). "/uploads/users/".$id."/temp/".$receivable_name."/". $action->title.'/';
                foreach($action_files as $file) {
                    if(!is_dir($action_file_dir.$file->document_title. "/")) {
                        mkdir($action_file_dir."/".$file->document_title. "/", 0777);
                    }
                    
                    //Documents
                    $scan_dir_path = public_path(). "/uploads/users/".$id."/actions/" .$action->id. "/". $file->id.'/';
                    if(File::isDirectory($scan_dir_path)) {  
                        $a = scandir($scan_dir_path);
                        if(count($a) > 0) {
                            foreach($a as $key => $val) {
                                if ($val != "." && $val != "..") { 
                                    copy($scan_dir_path . $val, $$action_dir . $file->document_title.'/'.$val);
                                }
                            }
                        }                        
                    }
                }
            }
        }
        $download_count++;
        
        //Download Zip
        if($download_count > 0) {
            $user = User::whereId($id)->first();
            $fileName = $user->first_name.' '.$user->last_name.'.zip';
            $zip_file = public_path('uploads/users/'.$id.'/'.$fileName);
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            $path = public_path('uploads/users/'.$id.'/temp');
            if(File::isDirectory($path)){
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
                foreach ($files as $name => $file)
                {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($path) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
                $temp_dir_path = public_path().'/uploads/users/'.$id.'/temp';
                File::deleteDirectory($temp_dir_path);
                return response()->download($zip_file)->deleteFileAfterSend(true);
            }
        }else{
            $temp_dir_path = public_path().'/uploads/users/'.$id.'/temp';
            File::deleteDirectory($temp_dir_path);
            return redirect()->back()->with('danger', 'There are no files to downloads!.');
        }


    }



}
