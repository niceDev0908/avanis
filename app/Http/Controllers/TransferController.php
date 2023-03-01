<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Receivables;
use App\UserRecipient;
use App\ReceivableRecipient;
use App\Mail\AddTransfersMail;
use Mail;

class TransferController extends Controller
{
    public function index() {

        $transfers = Receivables::where('user_id', Auth::user()->id)->where('currency', '!=', null)->get();

        return view('transfers.index', compact('transfers'));
    }

    public function addTransferAction(Request $request) {

        $post_array = $request->post();
        $transferData = $request->all();

        $data = new Receivables;
        $data->user_id = Auth::user()->id;
        $data->date = $post_array['transfer_date'];
        $data->amount = $post_array['amount'];
        $data->currency = $post_array['currency'];
        $data->planning_fee = Auth::user()->planning_fee;
        $data->avanis_fee = Auth::user()->avanis_fee;

        $success = $data->save();

        if($post_array['currency'] == 'pound')
            $currency_symbol = '£';
        else if($post_array['currency'] == 'dollar') 
            $currency_symbol = '$';
        else if($post_array['currency'] == 'euro') 
            $currency_symbol = '€';

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
                'message' => $transferData,
                'currency_symbol' => $currency_symbol,
                'body' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'subject' => $product_type . ' added by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name,
            ];

           Mail::to(config('app.from_mail_address'), config('app.name'))->send(new AddTransfersMail($data));
        } else {
            if(Auth::user()->product_type == 'CFP') {
                $message = "Error in adding CFP transaction. Please try again.";
            } else {
                $message = "Error in adding factor receivable. Please try again.";
            }
            $message_class = "failure";
        }

        return redirect()->route('transfers')->with($message_class, $message);


    }
}
