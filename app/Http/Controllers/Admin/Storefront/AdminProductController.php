<?php

namespace App\Http\Controllers\Admin\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AdminProductController extends Controller
{
    public function index(){

        $data['heading_title'] = "Products";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
			'text' => 'Products',
			'href' => URL::to('/admin/storefront/product')
		];

        $data['add'] = URL::to('/admin/storefront/product-form');

        return view('admin.storefront.product',$data);
    }
    
    public function form(){ 

        $data['heading_title'] = "Products";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
			'text' => 'Products',
			'href' => URL::to('/admin/storefront/product')
		];
        $data['breadcrumbs'][] = [
			'text' => 'Add Product',
			'href' => URL::to('/admin/storefront/product-form')
		];

        $data['back'] = URL::to('/admin/storefront/product');
        $data['save'] = URL::to('/admin/storefront/product-save');

        return view('admin.storefront.product_form',$data);
    }
}
