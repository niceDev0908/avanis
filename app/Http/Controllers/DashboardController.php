<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\AnnualCompliance;
use App\UserActionDocument;
use App\UserActionDocumentRequested;
use App\Mail\NewRequestedDocumentUploaded;
use Mail;

class DashboardController extends Controller {

    public function index(Request $request) {
        $action_files = UserActionDocument::with(['user_action.receivable'])->whereHas('user_action', function($query) {
                    $query->where('user_id', '=', Auth::user()->id)->where('action_status', '!=', 2);
                })->orderBy('id', 'desc')->get();

        $annual_compliance = AnnualCompliance::where('user_id', Auth::user()->id)->first();

        return view('dashboard', compact('action_files', 'annual_compliance'));
    }

    public function upload_requested_document_action(Request $request) {
        $post_array = $request->post();

        $files = $request->file();
        $files = $files['file'];

        $filename = $files->getClientOriginalName();
        $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
        $files->move(public_path('uploads/users/' . Auth::user()->id . '/actions/' . $post_array['action_id'] . '/' . $post_array['action_document_id']), $modified_ref_file_name);

        $add_doc = new UserActionDocumentRequested;
        $add_doc->user_action_document_id = $post_array['action_document_id'];
        $add_doc->document_name = $modified_ref_file_name;
        $add_doc->status = 1;
        $add_doc->save();

        $user_action_doc = UserActionDocument::find($post_array['action_document_id']);
        $user_action_doc->is_signed = 1;
        $user_action_doc->save();
    }

    public function view_requested_uploaded_documents($doc_id) {
        $documents = UserActionDocumentRequested::with(['action_document'])->where('user_action_document_id', $doc_id)->get();

        return view('view-requested-uploaded-documents', compact('documents'));
    }

    public function after_file_uploaded(Request $request) {
        $post_array = $request->post();

        $user_action_doc = UserActionDocument::with(['user_action'])->find($post_array['action_document_id']);

        $action_url = url('/') . '/admin/users/documents/' . $user_action_doc->user_action->user_id . '/edit/' . $user_action_doc->user_action_id;
        $data = [
            'name' => Auth::user()->first_name . " " . Auth::user()->last_name,
            'action_url' => $action_url,
            'subject' => Auth::user()->first_name . " " . Auth::user()->last_name . " has uploaded the requested document for action " . $user_action_doc->document_title,
            'action_document_title' => $user_action_doc->document_title,
        ];

        Mail::to(config('app.from_mail_address'), config('app.name'))->send(new NewRequestedDocumentUploaded($data));
        exit;
    }

}
