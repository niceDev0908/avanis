<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserAction;
use App\UserActionDocument;
use App\UserActionDocumentRequested;
use App\Mail\DocsAssignToUserMail;
use Session;
use DB;
use File;
use Mail;
use Illuminate\Support\Facades\Auth;

class UserActionController extends Controller {

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

        $data = UserAction::with('receivable')->where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $user_data = User::where('id', $user_id)->first();

        return view('admin.documents.index', compact('data', 'user_id', 'user_data'));
    }

    public function create_edit($user_id, $edit, $id = '') {
        $user_data = User::where('id', $user_id)->first();

        //Receivables
        $receivables = \App\Receivables::where('user_id', $user_id)->get();

        $requested_documents = [];
        if ($id == "") {
            $data = new UserAction;
        } elseif ($id > 0) {
            $data = UserAction::with(['user_action_documents'])->where('id', $id)->first();

            $requested_documents = UserActionDocument::with(['user_action_required_document'])->where('user_action_id', $id)->get();

            if (isset($data->user_id) && $data->user_id > 0) {
                $valid_user = User::where('id', $data->user_id)->select('id', 'intermediary_code')->first();
            }

            if (Auth::user()->intermediary_code != "") {
                $temp_arr = explode(",",Auth::user()->allows_intermediary_code);
                $intermediary_code = $temp_arr;             
                array_push($intermediary_code,Auth::user()->intermediary_code);

                $valid_users = User::whereIn('intermediary_code', $intermediary_code)->select('id')->get();
                if (isset($valid_users) && !empty($valid_users)) {
                    $users_arr = array_column($valid_users->toArray(), 'id');
                    if (!in_array($valid_user->id, $users_arr)) {
                        return redirect()->route('admin.users')->with("danger", "You are not authorized to view this page.");
                    }
                }
            }
        }

        return view('admin.documents.create_edit', compact('data', 'user_id', 'user_data', 'requested_documents', 'receivables'));
    }

    public function create_edit_action(Request $request) {
        $post_array = $name = $request->post();
        $id = (isset($post_array['id']) && $post_array['id'] > 0) ? $post_array['id'] : 0;
        $user_id = $post_array['user_id'];

        if ($id == 0) {
            $data = new UserAction;
        } else if ($id > 0) {
            $data = UserAction::find($id);
        }


        $data->user_id = $user_id;
        $data->title = $post_array['title'];
        $data->receivable_id = $post_array['receivable_id'];
        if ($id == 0) {
            if (isset($post_array['is_request_document'])) {
                $data->is_request_document = $post_array['is_request_document'];
            } else {
                $data->is_request_document = 0;
            }
        } else {
            $post_array['is_request_document'] = $data->is_request_document;
        }
        $data->status = 1;
        $data->action_status = $post_array['action_status'];
        $success = $data->save();



        $last_inserted_action_id = DB::getPdo()->lastInsertId();
        if ($last_inserted_action_id > 0) {
            $action_id = $last_inserted_action_id;
        } else {
            $action_id = $id;
        }

        if (isset($post_array['is_request_document'])) {
            for ($i = 0; $i < count($post_array['document_title']); $i++) {
                if (trim($post_array['document_title'][$i]) != "") {
                    $add_doc = new UserActionDocument;
                    if ($last_inserted_action_id > 0) {
                        $action_id = $last_inserted_action_id;
                    } else {
                        $action_id = $id;
                    }
                    $add_doc->user_action_id = $action_id;
                    $add_doc->document_title = $post_array['document_title'][$i];
                    $add_doc->is_signed = 0;
                    $add_doc->status = 1;
                    $add_doc->save();
                }
            }

            if ($request->hasFile('requested_document')) {
                $files = $request->file('requested_document');

                foreach ($files as $key => $value) {
                    $filename = $value->getClientOriginalName();
                    $extension = $value->getClientOriginalExtension();
                    $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);

                    $action_id = $id;

                    $add_req_doc = new UserActionDocumentRequested;
                    $add_req_doc->user_action_document_id = $key;
                    $add_req_doc->document_name = $modified_ref_file_name;
                    $add_req_doc->status = 1;
                    $add_req_doc->save();
                    $value->move(public_path('uploads/users/' . $user_id . '/actions/' . $action_id . '/' . $key . '/'), $modified_ref_file_name);

                    $user_action_document = UserActionDocument::where('id', $key)->first();
                    $user_action_document->is_signed = 1;
                    $user_action_document->save();
                }

                // After all requested documents are uploaded when the is Reqest Document is 1 than update the action status as completed
                $signed_documents = UserActionDocument::where('user_action_id', $action_id)->get();
                $signed_documents_completed = UserActionDocument::where('user_action_id', $action_id)->where('is_signed', 1)->get();
                if (count($signed_documents->toArray()) == count($signed_documents_completed->toArray()) && count($signed_documents->toArray()) > 0) {
                    $data->action_status = 1;
                    $data->save();
                }
            }
        }

        if ($request->hasFile('upload_action_docs')) {
            $files = $request->file('upload_action_docs');
            $filename = $request->upload_action_docs->getClientOriginalName();
            $extension = $request->upload_action_docs->getClientOriginalExtension();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);

            $add_doc = new UserActionDocument;
            if ($last_inserted_action_id > 0) {
                $action_id = $last_inserted_action_id;
            } else {
                $action_id = $id;
            }
            $add_doc->user_action_id = $action_id;
            $add_doc->document_title = $request->document_title;
            $add_doc->document_name = $modified_ref_file_name;
            $add_doc->is_signed = 0;
            $add_doc->status = 1;
            $add_doc->save();
            $request->upload_action_docs->move(public_path('uploads/users/' . $user_id . '/actions/' . $action_id . '/'), $modified_ref_file_name);
        }

        for ($i = 0; $i < count($request->document_title); $i++) {
            if (trim($request->document_url[$i]) != "" && $request->document_title[$i] != "") {
                $add_doc = new UserActionDocument;
                if ($last_inserted_action_id > 0) {
                    $action_id = $last_inserted_action_id;
                } else {
                    $action_id = $id;
                }
                $add_doc->user_action_id = $action_id;
                $add_doc->document_url = $request->document_url[$i];
                $add_doc->document_title = $request->document_title[$i];
                #$add_doc->document_name = $modified_ref_file_name;
                $add_doc->is_signed = 0;
                $add_doc->status = 1;
                $add_doc->save();
            }
        }

        // Upload signed documents
        if ($request->hasFile('signed_document')) {
            $files = $request->file('signed_document');

            foreach ($files as $key => $value) {
                $filename = $value->getClientOriginalName();
                $extension = $value->getClientOriginalExtension();
                $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);

                $action_id = $id;

                $add_doc = UserActionDocument::find($key);
                $add_doc->document_name = $modified_ref_file_name;
                $add_doc->is_signed = 1;
                $add_doc->save();
                $value->move(public_path('uploads/users/' . $user_id . '/actions/' . $action_id . '/'), $modified_ref_file_name);
            }

            // After all signed documents are uploaded when the is Reqest Document is 0 than update the action status as completed
            $signed_documents = UserActionDocument::where('user_action_id', $action_id)->get();
            $signed_documents_completed = UserActionDocument::where('user_action_id', $action_id)->where('is_signed', 1)->get();
            if (count($signed_documents->toArray()) == count($signed_documents_completed->toArray()) && count($signed_documents->toArray()) > 0) {
                $data->action_status = 1;
                $data->save();
            }
        }




        $user = User::where('id', $user_id)->first();
        $assign_url = url('/');
        $email_data = [
            'name' => config('app.name'),
            'message' => $user->toArray(),
            'body' => $assign_url,
            'subject' => 'Documents are Assigned by Admin  ',
        ];

        if ($success) {
            if ($id == 0) {
                #Mail::to($user->email, config('app.name'))->send(new DocsAssignToUserMail($email_data));
                $message = "User Action added successfully.";
            } else if ($id > 0) {
                $message = "User Action updated successfully.";
            }
            $message_class = "success";
        } else {
            if ($id == 0) {
                $message = "Error in adding User Action. Please try again.";
            } else if ($id > 0) {
                $message = "Error in updating User Action. Please try again.";
            }
            $message_class = "danger";
        }
        return redirect()->route('admin.users.documents', $user_id)->with($message_class, $message);
    }

    public function upload_adobe_document(Request $request) {
        $tokenResponse = generateAccessToken();

        //$access_token = $tokenResponse->access_token;

        $access_token = '3AAABLblqZhCHOTKkyKlEHfwCDxAaUaakx7qroEkeeuxq4j3vV3TtHY1CNJWpcfy8ixybev2XiiYGW-E6Xt3icQt0_AMoTTCs';

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $modified_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
        $file->move(public_path('uploads/adobe/'), $modified_file_name);
        $filePath = '@' . file_get_contents(public_path('uploads/adobe/' . $modified_file_name));
        $doc_arr = array('File' => $filePath, 'Mime-Type' => 'application/pdf', 'File-Name' => $modified_file_name);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.eu1.adobesign.com/api/rest/v6/transientDocuments",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $doc_arr,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $access_token,
                "content-type: multipart/form-data",
            ),
        ));
        $document = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $document = json_decode($document);

        if ($document->transientDocumentId) {

            $transient_id = $document->transientDocumentId;
            $widget_arr = [
                'fileInfos' => [
                        [
                        'transientDocumentId' => $transient_id,
                    ]
                ],
                'name' => 'Test PDF',
                'state' => "AUTHORING",
                'widgetParticipantSetInfo' => [
                    'memberInfos' => [[
                    'email' => '',
                        ]],
                    'role' => 'SIGNER'
                ],
            ];

            $widget = curl_init();
            curl_setopt_array($widget, array(
                CURLOPT_URL => "https://api.eu1.echosign.com:443/api/rest/v6/widgets",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($widget_arr),
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer " . $access_token,
                    "content-type: application/json",
                ),
            ));
            $widget_res = curl_exec($widget);
            $error = curl_error($widget);
            curl_close($widget);
            $widget_res = json_decode($widget_res);
            $widget_id = $widget_res->id;
            if ($widget_id) {
                $widget_url_arr = array('name' => $request->doc_title);
                $widget_url = curl_init();
                curl_setopt_array($widget_url, array(
                    CURLOPT_URL => "https://api.eu1.echosign.com:443/api/rest/v6/widgets/" . $widget_id . "/views",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($widget_url_arr),
                    CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer " . $access_token,
                        "content-type: application/json",
                    ),
                ));
                $widget_url_res = curl_exec($widget_url);
                $error = curl_error($widget_url);
                curl_close($widget_url);
                $widget_url_res = json_decode($widget_url_res);
                echo '<pre>';
                print_r($widget_url_res);
            }
        }

        $return['transient_id'] = $transient_id;
        $return['widget_id'] = $widget_id;

        return $return;
    }

    public function destroy($id) {
        $data = UserAction::find($id);

        $del_action_records = UserActionDocument::where('user_action_id', $id)->forceDelete();
        $delete_action_docs = File::deleteDirectory(public_path('uploads/users/' . $data->user_id . '/actions/' . $id));

        $response = $data->delete();

        if ($response) {
            Session::flash('success', 'User Action deleted successfully.');
            $success = 1;
        } else {
            Session::flash('danger', 'Error in deleting User Action. Please try again.');
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
        $response = UserAction::whereIn('id', $post_array['ids'])
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
        $del_ids = $request->post();
        $response = [];
        foreach ($del_ids as $del_id) {
            foreach ($del_id as $del_id) {
                $data = UserAction::where('id', $del_id)->first();
                $del_action_records = UserActionDocument::where('user_action_id', $del_id)->forceDelete();
                $delete_action_docs = File::deleteDirectory(public_path('uploads/users/' . $data->user_id . '/actions/' . $data->id));
                $response = UserAction::where('id', $data->id)->delete();
            }
        }
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

    public function delete_action_document($id) {

        $data = UserActionDocument::where('id', $id)->where('is_signed', 0)->first();
        $user_action_id = $data->user_action_id;

        $user = UserAction::where('id', $data->user_action_id)->first();
        $user_id = $user->user_id;

        #unlink(public_path('uploads/users/' . $user_id . '/actions/'.$data->user_action_id .'/'. $data->document_name));

        $response = $data->forceDelete();
        if ($response) {
            $success = 1;
        } else {
            $success = 0;
        }
        $return['success'] = $success;

        return response()->json($return);
    }

}
