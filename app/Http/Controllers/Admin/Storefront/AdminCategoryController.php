<?php

namespace App\Http\Controllers\Admin\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminCategoryController extends Controller
{
    public function index(){
        $data['heading_title'] = "Category";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Category',
            'href' => URL::to('/admin/storefront/category')
        ];

        $data['add'] = URL::to('/admin/storefront/category');

        // Pagination
        // $perPage = 20;
        // $currentPage = request()->query('page', 1);
        // $results = DB::select($query);
        // $products = collect($results);
        // $totalCount = $products->count();
        // $paginator = new LengthAwarePaginator(
        //     $products->forPage($currentPage, $perPage),
        //     $totalCount,
        //     $perPage,
        //     $currentPage,
        //     ['path' => request()->url(), 'query' => request()->query()]
        // );

        // $data['products'] = $paginator;
        $data['pagination'] = [];

        return view('admin.storefront.category', $data);
    }

    public function saveCategory(){
        $data['heading_title'] = "Category";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Category',
            'href' => URL::to('/admin/storefront/category')
        ];

        $data['add'] = URL::to('/admin/storefront/category');

        return view('admin.storefront.category_form', $data);
    }
}
