<?php

namespace App\Http\Controllers\Admin\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Admin\Storefront\Product\Product;
use App\Models\Admin\Storefront\Product\ProductCategory;
use App\Models\Admin\Storefront\Product\ProductDiscount;
use App\Models\Admin\Storefront\Product\ProductDownload;
use App\Models\Admin\Storefront\Product\ProductFilter;
use App\Models\Admin\Storefront\Product\ProductImage;
use App\Models\Admin\Storefront\Product\ProductOtherLink;
use App\Models\Admin\Storefront\Product\ProductPrice;
use App\Models\Admin\Storefront\Product\ProductReward;
use App\Models\Admin\Storefront\Product\ProductSpecial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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

        $data['products'] = DB::select('
                            SELECT 
                                p.id as product_id,
                                pi.image,
                                p.product_name,
                                p.model,
                                pp.list_price,
                                pp.mrp,
                                p.quantity 
                            FROM 
                                products p 
                            LEFT JOIN 
                                product_images pi ON p.id = pi.product_id 
                            LEFT JOIN 
                                product_prices pp ON pp.product_id = p.id
                        ');

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

        $data['action'] = route('admin-product-save');
        $data['back'] = URL::to('/admin/storefront/product');
        $data['save'] = URL::to('/admin/storefront/product-save');

        return view('admin.storefront.product_form',$data);
    }

    public function save(Request $request){
        $data = $request->request;

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'tag' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'model' => 'required|nullable|string|max:255',
            'sku' => 'nullable|string|max:20',
            'upc' => 'nullable|string|max:20',
            'ean' => 'nullable|string|max:20',
            'jan' => 'nullable|string|max:20',
            'isbn' => 'nullable|string|max:20',
            'mpn' => 'nullable|string|max:20',
            'quantity' => 'required|integer',
            'minimum' => 'nullable|integer',
            'subtract' => 'nullable|integer',
            'stock_status_id' => 'nullable|integer',
            'date_available' => 'nullable|date',
            'shipping' => 'nullable|boolean',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'length_class_id' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'weight_class_id' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'list_price' => 'nullable|numeric',
            'mrp' => 'nullable|numeric'
        ]);

        try{
            // Inserting a new product using the save method
            if(null !== $data->get('product_name') || null !== $data->get('model')){
                $product = new Product();
                $product->product_name = $data->get('product_name') ?? '';
                $product->product_description = $data->get('description') ?? '';
                $product->tag = $data->get('product_tag') ?? '';
                $product->meta_title = $data->get('meta_tag_title') ?? '';
                $product->meta_description = $data->get('meta_description') ?? '';
                $product->meta_keyword = $data->get('meta_tag_keyword') ?? '';
                $product->model = $data->get('model') ?? '';
                $product->sku = $data->get('sku') ?? '';
                $product->upc = $data->get('upc') ?? '';
                $product->ean = $data->get('ean') ?? '';
                $product->jan = $data->get('jan') ?? '';
                $product->isbn = $data->get('isbn') ?? '';
                $product->mpn = $data->get('mpn') ?? '';
                $product->quantity = (int)$data->get('quantity') ?? '';
                $product->minimum = (int)$data->get('minimum') ?? '';
                $product->subtract = (int)$data->get('subtract') ?? '';
                $product->stock_status_id = $data->get('stock_status_id') ?? null;
                $product->date_available = now();
                $product->shipping = true;
                $product->length = $data->get('length') ?? '';
                $product->width = $data->get('width') ?? '';
                $product->height = $data->get('height') ?? '';
                $product->length_class_id = $data->get('length_class_id') ?? null;
                $product->weight = $data->get('weight') ?? '';
                $product->weight_class_id = $data->get('weight_class_id') ?? null;
                $product->status = true;
                $product->sort_order = (int)$data->get('sort_order') ?? '';
                $product->save();
            }
 
             // last product id
             $product_id = $product->id;
 
            if(isset($product_id)){
                // product to category
                if(null !== $data->get('category_id') || null !== $data->get('category_id')){
                    $category = new ProductCategory();
                    $category->product_id = (int)$product_id;
                    $category->category_id = 1;
                    $category->save();
                }
                
                // product price 
                if (!empty($validatedData['list_price']) && !empty($validatedData['mrp'])) {
                    $price = new ProductPrice();
                    $price->product_id = $product_id;
                    $price->list_price = null;
                    $price->mrp = null;
                    $price->save();
                }
    
                // product discount
                if(null !== $data->get('discount_price') || null !== $data->get('discount_price')){
                    $discount = new ProductDiscount();
                    $discount->product_id = $product_id;
                    $discount->customer_group_id = null;
                    $discount->quantity = null;
                    $discount->priority = null;
                    $discount->price = null;
                    $discount->start_date = null;
                    $discount->close_date = null;
                    $discount->save();
                }
    
                // product special
                if(null !== $data->get('special_price') || null !== $data->get('special_price')){
                    $special = new ProductSpecial();
                    $special->product_id = $product_id;
                    $special->customer_group_id = null;
                    $special->priority = null;
                    $special->price = 0.0000;
                    $special->start_date = null;
                    $special->close_date = null;
                    $special->save();
                }
    
                // product downloads
                if(null !== $data->get('download_id') || null !== $data->get('download_id')){
                    $download = new ProductDownload();
                    $download->product_id = $product_id;
                    $download->download_id = 0;
                    $download->save();
                }
    
                // Product Reward
                if(null !== $data->get('point') || null !== $data->get('point')){
                    $reward = new ProductReward();
                    $reward->product_id = $product_id;
                    $reward->point = 0;
                    $reward->save();
                }
    
                // Product Reward
                if(null !== $data->get('filter_id') || null !== $data->get('filter_id')){
                    $filter = new ProductFilter();
                    $filter->product_id = $product_id;
                    $filter->filter_id = 0;
                    $filter->save();
                }
    
                // Product Image
                if(null !== $data->get('image') || null !== $data->get('image')){
                    $image = new ProductImage();
                    $image->product_id = $product_id;
                    $image->image = null;
                    $image->sort = null;
                    $image->save();
                }
    
                // Product other links
                if($data->get('amazon') != '' || $data->get('flipkart') != '' || $data->get('myntra') != '' || $data->get('ajio') != '' || $data->get('meesho') != ''){
                    $otherLink = new ProductOtherLink();
                    $otherLink->product_id = $product_id;;
                    $otherLink->amazon = null;
                    $otherLink->flipkart = null;
                    $otherLink->myntra = null;
                    $otherLink->ajio = null;
                    $otherLink->meesho = null;
                    $otherLink->status = false;
                    $otherLink->save();
                }
            }            
             return redirect('admin/storefront/product')->with('success', 'Product created successfully.');
 
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function editProduct(Request $request, $product_id){
        $data['heading_title'] = "Edit Product";

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
			'text' => 'Edit Product',
			'href' => URL::to('/admin/storefront/product-form')
		];

        $data['action'] = route('admin-product-update', ['product_id'=>$product_id]);
        $data['back'] = URL::to('/admin/storefront/product');
        $data['save'] = URL::to('/admin/storefront/product-save');

        $query = " SELECT
                        p.*,
                        GROUP_CONCAT(DISTINCT pc.category_id ORDER BY pc.category_id ASC SEPARATOR ',') AS category_ids,
                        GROUP_CONCAT(DISTINCT pd.customer_group_id ORDER BY pd.customer_group_id ASC SEPARATOR ',') AS discount_customer_group_ids,
                        GROUP_CONCAT(DISTINCT pi.image ORDER BY pi.sort ASC SEPARATOR ',') AS images,
                        GROUP_CONCAT(DISTINCT pol.amazon ORDER BY pol.status ASC SEPARATOR ',') AS other_links_amazon,
                        GROUP_CONCAT(DISTINCT pp.list_price ORDER BY pp.list_price ASC SEPARATOR ',') AS prices_list,
                        GROUP_CONCAT(DISTINCT ps.customer_group_id ORDER BY ps.priority ASC SEPARATOR ',') AS special_customer_group_ids
                    FROM
                        products p
                    LEFT JOIN
                        product_categories pc ON p.id = pc.product_id
                    LEFT JOIN
                        product_discounts pd ON p.id = pd.product_id
                    LEFT JOIN
                        product_images pi ON p.id = pi.product_id
                    LEFT JOIN
                        product_other_links pol ON p.id = pol.product_id
                    LEFT JOIN
                        product_prices pp ON p.id = pp.product_id
                    LEFT JOIN
                        product_specials ps ON p.id = ps.product_id
                    WHERE
                        p.id = :product_id
                    GROUP BY
                        p.id limit 1
                ";
        
        $data['product'] = DB::select($query, ['product_id' => $product_id])[0] ?? null;  

        return view('admin/storefront/product_form',$data);
    }

    public function updateProduct(Request $request, $product_id){
        $data = $request->request;
        // dd($data);

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'tag' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'model' => 'required|nullable|string|max:255',
            'sku' => 'nullable|string|max:20',
            'upc' => 'nullable|string|max:20',
            'ean' => 'nullable|string|max:20',
            'jan' => 'nullable|string|max:20',
            'isbn' => 'nullable|string|max:20',
            'mpn' => 'nullable|string|max:20',
            'quantity' => 'required|integer',
            'minimum' => 'nullable|integer',
            'subtract' => 'nullable|integer',
            'stock_status_id' => 'nullable|integer',
            'date_available' => 'nullable|date',
            'shipping' => 'nullable|boolean',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'length_class_id' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'weight_class_id' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'list_price' => 'nullable|numeric',
            'mrp' => 'nullable|numeric'
        ]);

        try{
            if (!empty($product_id)) {
                if(null !== $data->get('product_name') || null !== $data->get('model')){
                    $product = Product::find($product_id);
                    $product->product_name = $data->get('product_name') ?? '';
                    $product->product_description = $data->get('description') ?? '';
                    $product->tag = $data->get('product_tag') ?? '';
                    $product->meta_title = $data->get('meta_tag_title') ?? '';
                    $product->meta_description = $data->get('meta_description') ?? '';
                    $product->meta_keyword = $data->get('meta_tag_keyword') ?? '';
                    $product->model = $data->get('model') ?? '';
                    $product->sku = $data->get('sku') ?? '';
                    $product->upc = $data->get('upc') ?? '';
                    $product->ean = $data->get('ean') ?? '';
                    $product->jan = $data->get('jan') ?? '';
                    $product->isbn = $data->get('isbn') ?? '';
                    $product->mpn = $data->get('mpn') ?? '';
                    $product->quantity = (int)$data->get('quantity') ?? '';
                    $product->minimum = (int)$data->get('minimum') ?? '';
                    $product->subtract = (int)$data->get('subtract') ?? '';
                    $product->stock_status_id = $data->get('stock_status_id') ?? null;
                    $product->date_available = now();
                    $product->shipping = true;
                    $product->length = $data->get('length') ?? '';
                    $product->width = $data->get('width') ?? '';
                    $product->height = $data->get('height') ?? '';
                    $product->length_class_id = $data->get('length_class_id') ?? null;
                    $product->weight = $data->get('weight') ?? '';
                    $product->weight_class_id = $data->get('weight_class_id') ?? null;
                    $product->status = true;
                    $product->sort_order = (int)$data->get('sort_order') ?? '';
                    $product->update();
                }

                // product to category
                if(null !== $data->get('category_id') || null !== $data->get('category_id')){
                    $category = ProductCategory::find($product_id);
                    $category->product_id = (int)$product_id;
                    $category->category_id = 1;
                    $category->update();
                }
                
                // product price 
                if (!empty($validatedData['list_price']) && !empty($validatedData['mrp'])) {
                    $price = ProductPrice::find($product_id);
                    $price->product_id = $product_id;
                    $price->list_price = null;
                    $price->mrp = null;
                    $price->update();
                }
    
                // product discount
                if(null !== $data->get('discount_price') || null !== $data->get('discount_price')){
                    $discount = ProductDiscount::find($product_id);
                    $discount->product_id = $product_id;
                    $discount->customer_group_id = null;
                    $discount->quantity = null;
                    $discount->priority = null;
                    $discount->price = null;
                    $discount->start_date = null;
                    $discount->close_date = null;
                    $discount->update();
                }
    
                // product special
                if(null !== $data->get('special_price') || null !== $data->get('special_price')){
                    $special = ProductSpecial::find($product_id);
                    $special->product_id = $product_id;
                    $special->customer_group_id = null;
                    $special->priority = null;
                    $special->price = 0.0000;
                    $special->start_date = null;
                    $special->close_date = null;
                    $special->update();
                }
    
                // product downloads
                if(null !== $data->get('download_id') || null !== $data->get('download_id')){
                    $download = ProductDownload::find($product_id);
                    $download->product_id = $product_id;
                    $download->download_id = 0;
                    $download->update();
                }
    
                // Product Reward
                if(null !== $data->get('point') || null !== $data->get('point')){
                    $reward = ProductReward::find($product_id);
                    $reward->product_id = $product_id;
                    $reward->point = 0;
                    $reward->update();
                }
    
                // Product Reward
                if(null !== $data->get('filter_id') || null !== $data->get('filter_id')){
                    $filter = ProductFilter::find($product_id);
                    $filter->product_id = $product_id;
                    $filter->filter_id = 0;
                    $filter->update();
                }
    
                // Product Image
                if(null !== $data->get('image') || null !== $data->get('image')){
                    $image = ProductImage::find($product_id);
                    $image->product_id = $product_id;
                    $image->image = null;
                    $image->sort = null;
                    $image->update();
                }
    
                // Product other links
                if($data->get('amazon') != '' || $data->get('flipkart') != '' || $data->get('myntra') != '' || $data->get('ajio') != '' || $data->get('meesho') != ''){
                    $otherLink = ProductOtherLink::find($product_id);
                    $otherLink->product_id = $product_id;;
                    $otherLink->amazon = null;
                    $otherLink->flipkart = null;
                    $otherLink->myntra = null;
                    $otherLink->ajio = null;
                    $otherLink->meesho = null;
                    $otherLink->status = false;
                    $otherLink->update();
                }           
                return redirect('admin/storefront/product')->with('success', 'Product updated successfully.');
            }
 
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function delete($product_id){
        try{
            Product::where('id',$product_id)->delete();
            ProductCategory::where('product_id', $product_id)->delete();
            ProductPrice::where('product_id', $product_id)->delete();
            ProductDiscount::where('product_id', $product_id)->delete();
            ProductSpecial::where('product_id', $product_id)->delete();
            ProductDownload::where('product_id', $product_id)->delete();
            ProductReward::where('product_id', $product_id)->delete();
            ProductFilter::where('product_id', $product_id)->delete();
            ProductImage::where('product_id', $product_id)->delete();
            ProductOtherLink::where('product_id', $product_id)->delete();
            return redirect('admin/storefront/product')->with('success', 'Product deleted successfully.');
        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
