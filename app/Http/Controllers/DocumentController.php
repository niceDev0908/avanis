<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserActionDocument;
use App\UserAction;

class DocumentController extends Controller {

    public function actions($id) {
        $actions = UserAction::with(['user_action_documents'])->where('user_id', Auth::user()->id)->where('receivable_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        return view('documents.actions', compact('actions'));
    }

    public function action_files($id) {
        $action_arr = UserAction::where('id', $id)->first();
        $action_files = UserActionDocument::where('user_action_id', $id)->orderBy('id', 'desc')->get();

        return view('documents.action_files', compact('action_arr', 'action_files'));
    }

}
