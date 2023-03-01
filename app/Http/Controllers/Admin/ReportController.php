<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Exports\TransactionsExport;
use App\Exports\UserReport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller {

    public function index() {
        $data['intermediary'] = User::role('Intermediary')->get()->count();

        return view('admin.reports.index', compact('data'));
    }

    public function export(Request $request) {
        $params = $request->post();
        
        return Excel::download(new TransactionsExport($params), 'users.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition: attachment;'
        ]);
    }

    public function export_users(Request $request){
        $params = $request->post();
        
        return Excel::download(new UserReport($params), 'user.csv',\Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'Content-Disposition: attachment;'
        ]);
    }

}
