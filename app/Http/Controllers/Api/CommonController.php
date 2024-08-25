<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Storefront\Product\Product;
use Illuminate\Http\Request;


class CommonController extends Controller
{
    public function apiLogin()
    {

        $data['data'] = [
            "error" => 0,
            "product" => Product::getProducts()
        ];
        return response()->json($data);
    }
}
