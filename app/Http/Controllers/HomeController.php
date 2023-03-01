<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use DB;

class HomeController extends Controller {

    public function index(Request $request) {
        return view('welcome');
    }

}
