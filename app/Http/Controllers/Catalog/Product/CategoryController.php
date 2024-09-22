<?php

namespace App\Http\Controllers\Catalog\Product;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request, $category_id=null){

        $sort = $request->query('sort');

        // Filter 
        $filter = [];
        if($sort === 'desc'){
            $filter['desc'] = $sort;
        }else if($sort === 'asc'){
            $filter['asc'] = $sort;
        }else if($sort === 'latest'){
            $filter['latest'] = 'desc';
        }else if($sort === 'discounted'){
            $filter['discounted'] = $sort;
        }else if($sort === 'low_to_high'){
            $filter['low_to_high'] = 'asc';
        }else if($sort === 'high_to_low'){
            $filter['high_to_low'] = 'desc';
        }

        if($category_id){
            $filter['category_id'] = $category_id;
        }
        
        // Pagination
        $perPage = 20;
        $currentPage = request()->query('page', 1);
        $results = Product::getProducts($filter);
        $products = collect($results);
        $totalCount = $products->count();
        $paginator = new LengthAwarePaginator(
            $products->forPage($currentPage, $perPage),
            $totalCount,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $data['products'] = $paginator;
        $data['pagination'] = $paginator;

        $data['colors'] = DB::table('colors')->get();
        $data['sizes'] = DB::table('size')->get();
        $data['sort'] = $sort;
        

        return view('catalog.product.category', $data);
    }
}
