<?php

namespace App\Http\Controllers\Catalog\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['route_profile'] = route('catalog.profile');
        $data['route_change_password'] = route('catalog.viewChangePassword');
        return view('catalog.account.dashboard', $data);
    }
}
