<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\AnnualCompliance;
use App\User;
use App\Mail\AnnualComplianceUpdated;
use Mail;

class AnnualComplianceController extends Controller {

    public function index() {

        $annual_compliance = AnnualCompliance::where('user_id', Auth::user()->id)->first();

        return view('annual_compliance.index', compact('annual_compliance'));
    }

    public function addAnnualComplianceAction(Request $request) {
        $post_array = $request->post();

        $data = AnnualCompliance::where('user_id', Auth::user()->id)->first();

        if (!isset($data) && empty($data)) {
            $data = new AnnualCompliance;
        }

        $data->user_id = Auth::user()->id;
        $data->dob = $post_array['dob'];
        $data->occupation = $post_array['occupation'];

        if ($request->hasFile('identification_1_file')) {
            $data->identification_1_option = $post_array['identification_1_option'];
            
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->identification_1_file)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->identification_1_file);
            }
            $filename = $request->identification_1_file->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->identification_1_file->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->identification_1_file = $modified_ref_file_name;
        }
        
        if ($request->hasFile('identification_2_file')) {
            $data->identification_2_option = $post_array['identification_2_option'];
            
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->identification_2_file)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->identification_2_file);
            }
            $filename = $request->identification_2_file->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->identification_2_file->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->identification_2_file = $modified_ref_file_name;
        }
        
        if ($request->hasFile('identification_3_file')) {
            $data->identification_3_option = $post_array['identification_3_option'];
            
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->identification_3_file)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->identification_3_file);
            }
            $filename = $request->identification_3_file->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->identification_3_file->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->identification_3_file = $modified_ref_file_name;
        }

        $data->company_name = $post_array['company_name'];
        $data->company_address = $post_array['company_address'];
        $data->no_of_directors = $post_array['no_of_directors'];
        $data->no_of_shareholders = $post_array['no_of_shareholders'];
        $data->no_of_beneficial_owners = $post_array['no_of_beneficial_owners'];
        $data->client_share_of_business = $post_array['client_share_of_business'];
        $data->company_year_end = $post_array['company_year_end'];


        if ($request->hasFile('certificate_of_incorporation')) {
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->certificate_of_incorporation)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->certificate_of_incorporation);
            }
            $filename = $request->certificate_of_incorporation->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->certificate_of_incorporation->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->certificate_of_incorporation = $modified_ref_file_name;
        }

        if ($request->hasFile('memorandum_and_articles')) {
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->memorandum_and_articles)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->memorandum_and_articles);
            }
            $filename = $request->memorandum_and_articles->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->memorandum_and_articles->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->memorandum_and_articles = $modified_ref_file_name;
        }

        if ($request->hasFile('current_appointments')) {
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->current_appointments)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->current_appointments);
            }
            $filename = $request->current_appointments->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->current_appointments->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->current_appointments = $modified_ref_file_name;
        }

        if ($request->hasFile('latest_reports_and_accounts')) {
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->latest_reports_and_accounts)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->latest_reports_and_accounts);
            }
            $filename = $request->latest_reports_and_accounts->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->latest_reports_and_accounts->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->latest_reports_and_accounts = $modified_ref_file_name;
        }

        $data->pmc_name = $post_array['pmc_name'];
        $data->pmc_address = $post_array['pmc_address'];
        $data->pmc_bank_name = $post_array['pmc_bank_name'];
        $data->pmc_account_name = $post_array['pmc_account_name'];
        $data->pmc_sort_code = $post_array['pmc_sort_code'];
        $data->pmc_account_number = $post_array['pmc_account_number'];


        if ($request->hasFile('pmc_certificate_of_incorporation')) {
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->pmc_certificate_of_incorporation)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->pmc_certificate_of_incorporation);
            }
            $filename = $request->pmc_certificate_of_incorporation->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->pmc_certificate_of_incorporation->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->pmc_certificate_of_incorporation = $modified_ref_file_name;
        }

        if ($request->hasFile('pmc_memorandum_and_articles')) {
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->pmc_memorandum_and_articles)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->pmc_memorandum_and_articles);
            }
            $filename = $request->pmc_memorandum_and_articles->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->pmc_memorandum_and_articles->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->pmc_memorandum_and_articles = $modified_ref_file_name;
        }

        if ($request->hasFile('pmc_current_appointments')) {
            if (is_file(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->pmc_current_appointments)) {
                unlink(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/') . $data->pmc_current_appointments);
            }
            $filename = $request->pmc_current_appointments->getClientOriginalName();
            $modified_ref_file_name = date('YmdHis') . '_' . str_replace(" ", "_", $filename);
            $request->pmc_current_appointments->move(public_path('uploads/users/' . Auth::user()->id . '/annual_compliance/'), $modified_ref_file_name);
            $data->pmc_current_appointments = $modified_ref_file_name;
        }

        $data->usdc_wallet_address = isset($post_array['usdc_wallet_address']) ? $post_array['usdc_wallet_address'] : null;
        $data->approved_date = NULL;

        $success = $data->save();

        if ($success) {
            $message = "Annual compliance updated successfully.";
            $message_class = "success";

            $email_data = [
                'name' => Auth::user()->first_name . " " . Auth::user()->last_name,
                'link' => url('/') . '/admin/annual-compliance/' . Auth::user()->id,
                'subject' => 'Annual Compliance Updated by ' . Auth::user()->first_name . " " . Auth::user()->last_name,
            ];
            Mail::to(config('app.from_mail_address'), config('app.name'))->send(new AnnualComplianceUpdated($email_data));
        } else {
            $message = "Error in adding annual compliance. Please try again.";
            $message_class = "failure";
        }

        return redirect()->route('annual-compliance')->with($message_class, $message);
    }

    public function annualComplianceFileDownload($slug) {
        $data = AnnualCompliance::where('user_id', Auth::user()->id)->first();

        $file = public_path() . "/uploads/users/" . Auth::user()->id . "/annual_compliance/" . $data->$slug;

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

}
