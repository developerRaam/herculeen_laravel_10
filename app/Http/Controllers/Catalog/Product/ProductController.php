<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog\Contact;

class ProductController extends Controller
{
    public function index(){
        return view('catalog.product.product');
    }
}
