<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\AnnualCompliance;
use App\UserReference;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Mail\AccountActiveMail;
use DB;
use Hash;
use Session;

class AnnualComplianceController extends Controller {

    public function index(Request $request) {
        if (Auth::user()->intermediary_code != '') {
            $temp_arr = explode(",",Auth::user()->allows_intermediary_code);
            $intermediary_code = $temp_arr;             
            array_push($intermediary_code,Auth::user()->intermediary_code);

            $annual_compliance = AnnualCompliance::with('user')->whereHas('user', function($query) use ($intermediary_code) {
                        $query->whereIn('intermediary_code', $intermediary_code);
                        $query->where('deleted_at',null);
                    })->orderBy('id', 'DESC')->get();
        } else {
            $annual_compliance = AnnualCompliance::with('user')->whereHas('user', function($query) {
                $query->where('deleted_at',null);
            })->orderBy('id', 'DESC')->get();
        }

        return view('admin.annual-compliance.index', compact('annual_compliance'));
    }

    public function viewAnnualCompliance($id) {
        if(Auth::user()->intermediary_code != "") {
            
            $temp_arr = explode(",",Auth::user()->allows_intermediary_code);
            $intermediary_code = $temp_arr;             
            array_push($intermediary_code,Auth::user()->intermediary_code);
                        
            $valid_users = User::whereIn('intermediary_code', $intermediary_code)->select('id')->get();
            if(isset($valid_users) && !empty($valid_users)) {
                $users_arr = array_column($valid_users->toArray(), 'id');
                if(!in_array($id, $users_arr)) {
                    return redirect()->route('admin.annual-compliance')->with("danger", "You are not authorized to view this page.");
                }
            }
        }
        
        $annual_compliance = AnnualCompliance::with('user')->where('user_id', $id)->first();
        
        return view('admin.annual-compliance.view', compact('annual_compliance'));
    }
    
    public function annualComplianceFileDownload($slug, $id) {
        $data = AnnualCompliance::where('user_id', $id)->first();
        
        $file = public_path() . "/uploads/users/" . $id . "/annual_compliance/" . $data->$slug;
        
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }
    
    public function approveAnnualCompliance(Request $request) {
        $post_array = $request->post();
        
        $data = AnnualCompliance::where('id', $post_array['id'])->first();
        
        $data->approved_date = date('Y-m-d H:i:s');
        
        $success = $data->save();

        if ($success) {
            $message = "Annual compliance approved successfully.";
            $message_class = "success";
        } else {
            $message = "Error in approving annual compliance. Please try again.";
            $message_class = "failure";
        }

        return redirect()->route('admin.annual-compliance')->with($message_class, $message);
        
    }

}
