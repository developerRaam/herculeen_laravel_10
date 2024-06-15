<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminContactController extends Controller
{
    public function index(){
        $contacts = [];

        return view('admin.contact', ['contacts'=>$contacts]);
    }
}
