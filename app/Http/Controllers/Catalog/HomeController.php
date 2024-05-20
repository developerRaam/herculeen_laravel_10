<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog\Contact;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }
}
