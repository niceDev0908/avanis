<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Receivables;
use App\ReceivableRecipient;
use App\UserReference;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Mail\AccountActiveMail;
use DB;
use Hash;
use Session;

class ReceivablesController extends Controller {

    public function index(Request $request) {

        if (Auth::user()->intermediary_code != '') {
            $temp_arr = explode(",",Auth::user()->allows_intermediary_code);
            $intermediary_code = $temp_arr;             
            array_push($intermediary_code,Auth::user()->intermediary_code);

            $receivables = Receivables::with('user')->whereHas('user', function($query) use ($intermediary_code) {
                        $query->whereIn('intermediary_code', $intermediary_code);
                    })->orderByDesc('date')->get();
        } else {
            $receivables = Receivables::with('user')->whereHas('user', function($query) {
                        $query->where('deleted_at', NULL);
                    })->orderByDesc('date')->get();
        }

        return view('admin.receivables.index', compact('receivables'));
    }

    public function destroy($id) {
        $data = Receivables::find($id);
        $response = $data->delete();

        if ($response) {
            Session::flash('success', 'Receivable deleted successfully.');
            $success = 1;
        } else {
            Session::flash('danger', 'Error in deleting Receivable. Please try again.');
            $success = 0;
        }

        $return['success'] = $success;

        return response()->json($return);
    }
    
    public function receivables_recipients_view($id) {
        $data = Receivables::with('user')->find($id);
        
        $user_recipients = ReceivableRecipient::where('receivable_id', $id)->orderBy('id', 'ASC')->get();
        
        return view('admin.receivables.recipients', compact('data', 'user_recipients'));
    }
    
    public function receivables_recipients_action(Request $request) {
        $post_array = $name = $request->post();
        
        $deletedRows = ReceivableRecipient::where('receivable_id', $post_array['id'])->delete();
        
        for ($i = 0; $i < count($post_array['recipient_name']); $i++) {
            if($i == 0) {
                continue;
            }
            
            $data_ins = new ReceivableRecipient;
            $data_ins->receivable_id = $post_array['id'];
            $data_ins->recipient_name = $post_array['recipient_name'][$i];
            $data_ins->planning_fee = $post_array['planning_fee'][$i];
            $data_ins->avanis_fee = $post_array['avanis_fee'][$i];
            $data_ins->save();
            
        }
        
        return redirect()->route('admin.receivables')->with("success", "Recipients updated successfully");
    }

}
