<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog\Contact;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $data['banners'] = DB::table('banners')->where('status', 1)->orderBy('sort','asc')->get();
        return view('catalog.index', $data);
    }
}
