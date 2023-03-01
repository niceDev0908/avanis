<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Asset;
use App\AssetLog;
use App\Mail\AssetNotificationMail;
use App\Mail\SendAssetNotificationMail;
use Validator;
use Session;
use Mail;
use File;

class AssetsController extends Controller
{
    public function index() {
        $data = Asset::whereUserId(Auth::user()->id)->get();
        return view('assets.create-edit',compact('data'));
    }

    public function create_edit_assets(Request $request) {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'assetValue' => 'required|numeric',
            'currency' => 'required',
            'current_price_per_unit' => 'required',
            'total_value_of_holding' => 'required',
            'asset_file' => 'image'
        ]);
        if (!$validator->passes()) {
            $return = [
                'response' => 2,
                'message' => $validator->errors()->all(),
                'class' => 'danger'
            ];
        }else {
            $id = $request->id;
            
            if($id == 0 || $id == "") {
                $data = new Asset;
                $action = 'added';
                $previous_file_name = '';
            }else if($id > 0) {
                $data = Asset::find($id);
                $action = 'edited';
                $previous_file_name = $data->asset_file;
                
                $asset_log = new AssetLog;
                $asset_log->asset_id = $id;
                $asset_log->description = $request->old_description;
                $asset_log->value = $request->old_assetValue;
                $asset_log->currency = $request->old_currency;
                $asset_log->current_price_per_unit = $request->old_current_price_per_unit;
                $asset_log->total_value_of_holding = $request->old_total_value_of_holding;
                $asset_log->user_id = Auth::user()->id;
                $asset_log->asset_file = $previous_file_name;
                $asset_log->save();
            }

            $data->description = $request->description;
            $data->value = $request->assetValue;
            $data->currency = $request->currency;
            $data->current_price_per_unit = $request->current_price_per_unit;
            $data->total_value_of_holding = $request->total_value_of_holding;
            $data->user_id = Auth::user()->id;

            if ($request->file('asset_file')) {
                $strtotime = date('YmdHis');
                $asset_file = $request->file('asset_file');
                $asset_file_name = $asset_file->getClientOriginalName();
                $asset_file_name = strtolower(str_replace(" ", "", $asset_file_name));
                $modified_file_name = $strtotime . '_' . $asset_file_name;
                $data->asset_file = $modified_file_name; 
            }
            $success = $data->save();
    
            if ($request->file('asset_file')) {
                $asset_file->move(public_path('uploads/user_assets/'. $data->id. '/'), $modified_file_name);
                if (is_file(public_path('uploads/user_assets/' . $data->id . '/' . $previous_file_name))) {
                    unlink(public_path('uploads/user_assets/' . $data->id . '/' . $previous_file_name));
                }
            }
            $details = [
                'action' => $action,
                'file' => public_path('uploads/user_assets/'. $data->id. '/'. $modified_file_name),
                'assets' => $data
            ];
            Mail::to('support@avanis.co.uk')->send(new AssetNotificationMail($details));

            if ($success) {
                $response = 1;
                $class = 'success';
                if($id == 0) {
                    $message = 'Currency created successfully.';
                } else if($id > 0) {
                    $message = 'Currency updated successfully.';
                }
            }else {
                $response = 0;
                $class = 'danger';
                if($id == 0) {
                    $message = 'Error in creating currency.';
                }else if($id > 0) {
                    $message = 'Error in updating currency.';
                }
            }
    
            $return['response'] = $response;
            $return['message'] = $message;
            $return['class'] = $class;
            $return['asset'] = $data;

        }
        return response()->json($return);
    }

    public function delete_asset($id) {
        $data = Asset::find($id);
        $success = $data->delete();

        if ($success) {
            File::deleteDirectory(public_path('uploads/user_assets/' . $id));
            $response = 1;
            $class = 'success';
            $message = 'Asset deleted successfully.';
        } else {
            $response = 0;
            $class = 'danger';
            $message = 'Error in deleting Asset. Please try again.';
        }

        $return = [
            'response' => $response,
            'message' => $message,
            'class' => $class
        ];
        
        return response()->json($return);
    }

    public function sendNotification(Request $request) {
        Mail::to('support@avanis.co.uk')->send(new SendAssetNotificationMail());
        if(count(Mail::failures()) > 0) {
            $return['response'] = 0;
            $return['message'] = 'Error in submitting the details.';
            $return['class'] = 'danger';
        }else {
            $return['response'] = 1;
            $return['message'] = 'You have submitted the details successfully.';
            $return['class'] = 'success';
        }

        return response()->json($return);
    }
}
