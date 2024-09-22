<?php

namespace App\Models\Catalog\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public static function getProduct($product_id){
        // products
        $product = DB::table('products')
                    ->leftJoin('product_prices', 'products.id', '=', 'product_prices.product_id')
                    ->select('products.*', 'product_prices.list_price','product_prices.mrp')
                    ->where('products.id', $product_id)->first();

        $images = DB::table('product_images')->where('product_id', $product_id)->get();

        $data['product'] = $product;
        $data['images'] = $images;

        return $data ?? null;
    }

    public static function getProducts($filter = array()){
        $query = 'SELECT p.id as product_id,p.image, p.product_name, p.tag, p.model, pp.list_price, pp.mrp, p.quantity,p.slug FROM  products p LEFT JOIN  product_prices pp ON pp.product_id = p.id  WHERE p.status=1';

        // Get Category
        if (isset($filter['category_id']) && null !== $filter['category_id']) {
            $product_ids = '';
            $category = DB::table('product_categories')->where('category_id', $filter['category_id'])->get();
            foreach ($category as $value) {
                $product_ids .= $value->product_id . ','; // Concatenate product IDs
            }
            // Remove the trailing comma, if any
            $product_ids = rtrim($product_ids, ',');

            if($product_ids){
                $query .= " and p.id IN (" . $product_ids . ")";
            }else{
                $query .= " and p.id IN (0)";
            }
        }

        // dd($query);

        // Filter
        if($filter){
            if (isset($filter['desc']) && null !== $filter['desc']) {
                $query .= " order by p.product_name " . $filter['desc'] . "";
            }
            if (isset($filter['asc']) && null !== $filter['asc']) {
                $query .= " order by p.product_name " . $filter['asc'] . "";
            }
            if (isset($filter['limit']) && null !== $filter['limit']) {
                $query .= " limit "  . $filter['limit'] . "";
            }
            if (isset($filter['latest']) && null !== $filter['latest']) {
                $query .= " order by p.created_at "  . $filter['latest'] . "";
            }
            if (isset($filter['low_to_high']) && null !== $filter['low_to_high']) {
                $query .= " order by pp.list_price "  . $filter['low_to_high'] . "";
            }
            if (isset($filter['high_to_low']) && null !== $filter['high_to_low']) {
                $query .= " order by pp.list_price "  . $filter['high_to_low'] . "";
            }
        }

        return DB::select($query);
    }
}
