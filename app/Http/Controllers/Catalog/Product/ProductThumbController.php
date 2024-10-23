<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog\Product\Product;

class ProductThumbController extends Controller
{
    public static function index()
    {
        $filter = [
            'latest' => 'desc',
            'limit' => '8'
        ];
        $data['products'] = Product::getProducts($filter);
        return view('catalog.product.thumb', $data);
    }
}
