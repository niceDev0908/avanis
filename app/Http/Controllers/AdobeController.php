<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdobeController extends Controller
{
    public function view_form(){
        return view('adobe.create');
    }
    
    public function upload_doc_action(Request $request){
        if($request->file('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $file->move(public_path('uploads/adobe/'), $modified_ref_file_name);
            $filePath= '@'.file_get_contents(public_path('uploads/adobe/'.$modified_ref_file_name));
            $fields = array('File' => $filePath,'Mime-Type' => 'application/pdf', 'File-Name' => $modified_ref_file_name);
            

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.eu2.adobesign.com/api/rest/v6/transientDocuments",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer 3AAABLblqZhDHZ7SFVSJCGHwt9Fm2f7fUyzXGBif3Ww86AjqpenewXSv-JHcGPIUCiOTLBdn6WZrosRPta4tub46kyruLnqhv",
                    "content-type: multipart/form-data",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo "<pre>";
                print_r(json_decode($response));
            }

        }
    }
}
