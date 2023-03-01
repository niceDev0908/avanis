<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PMCModule;
use Illuminate\Support\Facades\Auth;
use Validator;
use File;

class PMCController extends Controller
{
    public function index() {

        $pmc_data = PMCModule::where('user_id', Auth::user()->id)->get();
        
        return view('pmc.index', compact('pmc_data'));
    }

    public function addPmcActions(Request $request) {
        $response = null;
        $action_id = $request->pmc_id;
        $all_pmc_id = PMCModule::where('user_id', Auth::user()->id)->get();        
        
        if(!empty($request->hidden_pmc_type[0])) { 
            $hidden_pmc_type = $request->hidden_pmc_type;
            $count = count($hidden_pmc_type);
    
            for($i = 0; $i < $count; $i++) {
                if(isset($request->pmc_id[$i]) || !empty($request->pmc_id[$i])) {
                    $pmcID = $request->pmc_id[$i];
                    $pmc_module = PMCModule::find($pmcID);
                    $previous_file_name = $pmc_module->pmc_file_upload;
                }else {
                    $pmc_module = new PMCModule();
                    $previous_file_name = '';
                }
                $pmc_module->user_id = Auth::user()->id;
                $pmc_module->pmc_type = $request->hidden_pmc_type[$i];
                $pmc_module->pmc_description = $request->hidden_pmc_description[$i];
                $pmc_module->pmc_asset_in = $request->hidden_pmc_asset_in[$i];
                $pmc_module->pmc_asset_out = $request->hidden_pmc_asset_out[$i];
                $pmc_module->pmc_cash_in = $request->hidden_pmc_cash_in[$i];
                $pmc_module->pmc_cash_out = $request->hidden_pmc_cash_out[$i];
                $pmc_module->pmc_trust_val_bal = $request->hidden_pmc_trust_val_bal[$i];
                $pmc_module->pmc_date = $request->hidden_pmc_date[$i];
                
                if (isset($request->pmc_file_upload[$i])) {
                    $strtotime = date('YmdHis');
                    $pmc_doc = $request->pmc_file_upload[$i];
                    $pmc_doc_name = $pmc_doc->getClientOriginalName();
                    $pmc_doc_name = strtolower(str_replace(" ", "", $pmc_doc_name));
                    $modified_file_name = $strtotime . '_' . $pmc_doc_name;
                    $pmc_module->pmc_file_upload = $modified_file_name;
                }
                $response = $pmc_module->save();
                $pmc_module_id = $pmc_module->id;
    
                if (isset($request->pmc_file_upload[$i])) {
                    $pmc_doc->move(public_path('uploads/users/' . Auth::user()->id . '/pmc_docs/'. $pmc_module_id. '/'), $modified_file_name);
                    if (is_file(public_path('uploads/users/' . Auth::user()->id . '/pmc_docs/' . $pmc_module_id . '/' . $previous_file_name))) {
                        unlink(public_path('uploads/users/' . Auth::user()->id . '/pmc_docs/' . $pmc_module_id . '/' . $previous_file_name));
                    }
                }       
            }
            if (!empty($all_pmc_id)) {
                foreach ($all_pmc_id as $p_id) {
                    if (in_array($p_id->id, $action_id)) {
                    } else {
                        $delete = PMCModule::find($p_id->id);
                        File::deleteDirectory(public_path('uploads/users/' . Auth::user()->id . '/pmc_docs/' . $p_id->id));
                        $delete->delete();
                    }
                }
            }
        }
        if (empty($action_id) && !empty($request->another_id[0])) {
            foreach ($all_pmc_id as $p_id) {
                $delete = PMCModule::find($p_id->id);
                File::deleteDirectory(public_path('uploads/users/' . Auth::user()->id . '/pmc_docs/' . $p_id->id));
                $delete->delete();
            }
        }

        if($response) {
            $message = "PMC Transaction added successfully.";
            $message_class = "success";
        }else {
            $message = "Error in adding PMC Transaction. Please complete all fields below.";
            $message_class = "danger";
        }

        return redirect()->route('pmc-management')->with($message_class, $message);
    }
}
