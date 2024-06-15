<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDemoDataTableController extends Controller
{
    public function index(){

        $registerBrand = '';

        return view('admin.demo-data-table', ['registerBrand'=>$registerBrand]);
    }
}
