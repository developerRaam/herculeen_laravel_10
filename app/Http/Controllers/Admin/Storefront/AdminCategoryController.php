<?php

namespace App\Http\Controllers\Admin\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Admin\Storefront\Category\Category;
use Exception;

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

        $data['add'] = URL::to('/admin/storefront/category-form');

        $query = "WITH RECURSIVE CategoryHierarchy AS (
                SELECT 
                id, category_name, image, sort_order, status, parent_id, category_name AS full_path, 1 AS level 
                FROM category
                WHERE parent_id IS NULL  -- Assuming root categories have no parent
                UNION ALL
                -- Recursive member: Join child categories
                SELECT 
                    c.id, c.category_name, c.image, c.sort_order, c.status, c.parent_id, CONCAT(ch.full_path, ' > ', c.category_name) AS full_path, 
                    ch.level + 1 AS level
                FROM category c
                INNER JOIN CategoryHierarchy ch ON c.parent_id = ch.id)
                -- Select all columns from the recursive CTE
                SELECT * FROM CategoryHierarchy
                ORDER BY full_path ASC ;  -- Optionally order by level and sort_order
                ";

        // Pagination
        $perPage = 50;
        $currentPage = request()->query('page', 1);
        $results = DB::select($query);
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

        $data['pagination'] = $paginator;

        return view('admin.storefront.category', $data);
    }

    public function form(){
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
        $data['breadcrumbs'][] = [
            'text' => 'Add Category',
            'href' => URL::to('/admin/storefront/category-form')
        ];

        $data['action'] = Route('save-category');
        $data['back'] = URL::to('/admin/storefront/category');

        $query = "WITH RECURSIVE CategoryHierarchy AS (
            SELECT id, category_name, description, image, sort_order, status, parent_id, category_name AS full_path, 1 AS level 
            FROM category
            WHERE parent_id IS NULL
            UNION ALL
            SELECT c.id, c.category_name, c.description, c.image, c.sort_order, c.status, c.parent_id, CONCAT(ch.full_path, ' > ', c.category_name) AS full_path, ch.level + 1 AS level
            FROM category c
            INNER JOIN CategoryHierarchy ch ON c.parent_id = ch.id) 
            SELECT * FROM CategoryHierarchy 
            ORDER BY full_path ASC";

        $data['categories'] = DB::select($query);        

        return view('admin.storefront.category_form', $data);
    }

    public function save(Request $request)
    {
        $data = $request->request;

        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
            'meta_tag' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        try {
            
            if (null !== $data->get('category_name')) {

                // check exists category name
                // $categoryCheck = Category::where('category_name', $data->get('category_name'))->first();
                // if ($categoryCheck)
                //     return redirect('admin/storefront/category')->with('warning', 'Category already exists.');

                // Upload image
                $file = $request->file('image'); // get files
                if(null !== $file){
                    $folderPath = public_path('image/uploads/category');
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $imagePath = public_path('image/uploads/category') . $imageName;
                    if (!file_exists($imagePath)) {
                        $file->move(public_path('image/uploads/category/'), $imageName);
                    }
                }

                $category = new Category();
                $category->category_name = $data->get('category_name');
                $category->parent_id = $data->get('parent_id') ?? null;
                $category->description = $data->get('description') ?? '';
                $category->meta_tag = $data->get('meta_tag') ?? '';
                $category->image = $imageName ?? null;
                $category->sort_order = $data->get('sort_order') ?? 0;
                $category->status = ($data->get('status')) ? 1 : 0 ;
                $category->created_at = NOW();
                $category->updated_at = NOW();
                $category->save();
                return redirect('admin/storefront/category')->with('success', 'Category created successfully.');
            }else{
                return redirect('admin/storefront/category')->with('success', 'Category not created successfully.');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($category_id){
        $data['heading_title'] = "Edit category";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'categorys',
            'href' => URL::to('/admin/storefront/category')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Edit category',
            'href' => URL::to('/admin/storefront/category-edit/category_id='.$category_id)
        ];

        $data['action'] = route('update-category', ['category_id' => $category_id]);
        $data['back'] = URL::to('/admin/storefront/category');

        $query = "WITH RECURSIVE CategoryHierarchy AS (
            SELECT id, category_name, description, image, sort_order, status, parent_id, category_name AS full_path, 1 AS level 
            FROM category
            WHERE parent_id IS NULL
            UNION ALL
            SELECT c.id, c.category_name, c.description, c.image, c.sort_order, c.status, c.parent_id, CONCAT(ch.full_path, ' > ', c.category_name) AS full_path, ch.level + 1 AS level
            FROM category c
            INNER JOIN CategoryHierarchy ch ON c.parent_id = ch.id) 
            SELECT * FROM CategoryHierarchy ";

        $data['categories'] = DB::select($query. 'ORDER BY full_path ASC');
        $data['category'] = DB::select($query.' WHERE id ="'.$category_id.'"')[0];
    
        return view('admin/storefront/category_form', $data);
    }

    public function update(Request $request, $category_id){

        // dd($category_id);
        $data = $request->request;

        $request->validate([
            'category_name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
            'meta_tag' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        try {
            
            if (null !== $data->get('category_name')) {

                // Upload image
                $file = $request->file('image'); // get files
                if(null !== $file){
                    $folderPath = public_path('image/uploads/category');
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $imagePath = public_path('image/uploads/category') . $imageName;
                    if (!file_exists($imagePath)) {
                        $file->move(public_path('image/uploads/category/'), $imageName);
                    }
                }

                $category = Category::where('id',$category_id)->first();

                if ($category) {
                    $category->category_name = $data->get('category_name');
                    $category->parent_id = $data->get('parent_id') ?? null;
                    $category->description = $data->get('description') ?? '';
                    $category->meta_tag = $data->get('meta_tag') ?? '';
                    $category->image = $imageName ?? null;
                    $category->sort_order = $data->get('sort_order') ?? 0;
                    $category->status = ($data->get('status')) ? 1 : 0;
                    $category->updated_at = NOW();
                    $category->update();

                    return redirect('admin/storefront/category')->with('success', 'Category updated successfully.');
                } else {
                    return redirect('admin/storefront/category')->with('error', 'Category not found.');
                }
            }else{
                return redirect('admin/storefront/category')->with('success', 'Category not updated successfully.');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function delete($category_id)
    {
        try {
            Category::where('id', $category_id)->delete();
            return redirect('admin/storefront/category')->with('success', 'Category deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
