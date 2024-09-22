<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Catalog\Product\ProductThumbController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog\Contact;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        // $data['product_thumb'] = view('catalog.product.thumb')->render();

        // Product thumb template
        $data['product_thumb'] = ProductThumbController::index();

        $data['banners'] = DB::table('banners')->where('status', 1)->orderBy('sort','asc')->get();

        $data['category_route'] = route('catalog.category') . '?sort=latest';

        return view('catalog.index', $data);
    }
}
