<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Product\Product;
use Illuminate\Http\Request;
use App\Models\Catalog\Contact;

class ProductController extends Controller
{
    public function productDetail($product_id, $slug = null){
        $data['product'] = Product::getProduct($product_id);
        
        return view('catalog.product.product', $data);
    }
}
