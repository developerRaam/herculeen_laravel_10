<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Product\Product;
use Illuminate\Http\Request;
use App\Models\Catalog\Contact;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productDetail($product_id, $slug = null){
        $data['product'] = Product::getProduct($product_id);
        $data['ecommerce_url'] = DB::table('product_other_links')->where('product_id', $product_id)->first();
        
        return view('catalog.product.product', $data);
    }
}
