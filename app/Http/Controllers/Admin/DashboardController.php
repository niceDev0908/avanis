<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller {

    public function index() {
        if(Auth::user()->intermediary_code != '') {
            $temp_arr = explode(",",Auth::user()->allows_intermediary_code);
            $intermediary_code = $temp_arr;             
            array_push($intermediary_code,Auth::user()->intermediary_code);

            $data['cfp_users'] = User::role('User')->where('product_type', 'CFP')->whereIn('intermediary_code', $intermediary_code)->get()->count();
            $data['rsa_users'] = User::role('User')->where('product_type', 'RSA')->whereIn('intermediary_code', $intermediary_code)->get()->count();
            $data['gfs_users'] = User::role('User')->where('product_type', 'GFS')->whereIn('intermediary_code', $intermediary_code)->get()->count();
        } else {
            $data['cfp_users'] = User::role('User')->where('product_type', 'CFP')->get()->count();
            $data['rsa_users'] = User::role('User')->where('product_type', 'RSA')->get()->count();
            $data['gfs_users'] = User::role('User')->where('product_type', 'GFS')->get()->count();
        }
       	$data['intermediary'] = User::role('Intermediary')->get()->count();

        return view('admin.dashboard', compact('data'));
    }

}
