<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function getAllCategories(){

        // Pagination
        $perPage = 12;
        $currentPage = request()->query('page', 1);
        $results = DB::table('category')->where('status', true)->orderBy('id','desc')->get();
        $products = collect($results);
        $totalCount = $products->count();
        $paginator = new LengthAwarePaginator(
            $products->forPage($currentPage, $perPage),
            $totalCount,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $data['categories'] = $paginator;
        // dd($data['categories']);
        $data['pagination'] = $paginator;

        return view('catalog.product.category', $data);
    }
}
