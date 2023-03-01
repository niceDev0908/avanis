<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Receivables;
use App\User;
use App\UserRecipient;
use App\ReceivableRecipient;
use Mail;
use App\Mail\FactorReceivableMail;

class ReceivablesController extends Controller {

    public function index() {

        $receivables = Receivables::where('user_id', Auth::user()->id)->where('currency', '=', null)->get();

        return view('receivables.index', compact('receivables'));
    }

    public function addReceivablesAction(Request $request) {
        $post_array = $request->post();
        $factorReceivableData = $request->all();

        $data = new Receivables;
        $data->user_id = Auth::user()->id;
        $data->date = $post_array['receivable_date'];
        $data->amount = $post_array['amount'];
        $data->planning_fee = Auth::user()->planning_fee;
        $data->avanis_fee = Auth::user()->avanis_fee;

        $success = $data->save();

        if ($success) {
            
            $user_recipients = UserRecipient::where('user_id', Auth::user()->id)->orderBy('id', 'ASC')->get();
            foreach ($user_recipients as $key => $value) {
                $data_ins = new ReceivableRecipient;
                $data_ins->receivable_id = $data->id;
                $data_ins->recipient_name = $value->recipient_name;
                $data_ins->planning_fee = $value->planning_fee;
                $data_ins->avanis_fee = $value->avanis_fee;
                $data_ins->save();
            }
            
            if(Auth::user()->product_type == 'CFP') {
                $product_type = "CFP transaction";
            } else {
                $product_type = "Factor receivable";
            }
            $message = $product_type ." added successfully.";
            $message_class = "success";

            $data = [
                'name' => config('app.name'),
                'message' => $factorReceivableData,
                'body' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'subject' => $product_type . ' added by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name,
            ];

            Mail::to(config('app.from_mail_address'), config('app.name'))->send(new FactorReceivableMail($data));
        } else {
            if(Auth::user()->product_type == 'CFP') {
                $message = "Error in adding CFP transaction. Please try again.";
            } else {
                $message = "Error in adding factor receivable. Please try again.";
            }
            $message_class = "failure";
        }

        return redirect()->route('receivables')->with($message_class, $message);
    }

    public function receivable_actions() {
        $other_actions_count = \App\UserAction::where('user_id', Auth::user()->id)->where('receivable_id', 0)->count();
        
        $receivables = Receivables::with('user_action')->where('user_id', Auth::user()->id)->get();

        return view('receivables.receivable_actions', compact('receivables', 'other_actions_count'));
    }

}
