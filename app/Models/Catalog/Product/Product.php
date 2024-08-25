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
                    ->where('products.id', $product_id)->first();

        $images = DB::table('product_images')->where('product_id', $product->id)->get();

        $data['product'] = $product;
        $data['images'] = $images;

        return $data ?? null;
    }

    public static function getProducts($request = null){
        $query = 'SELECT p.id as product_id,p.image, p.product_name, p.model, pp.list_price, pp.mrp, p.quantity,p.slug FROM  products p LEFT JOIN  product_prices pp ON pp.product_id = p.id  WHERE 1=1';

        // Filter
        if($request){
            if (null !== $request->query('product_name')) {
                $query .= ' AND p.product_name=' . "'" . $request->query('product_name') . "'";
            }
            if (null !== $request->query('model')) {
                $query .= ' AND p.model=' . "'" . $request->query('model') . "'";
            }
            if (null !== $request->query('price')) {
                $query .= ' AND pp.list_price=' . "'" . $request->query('price') . "'";
            }
            if (null !== $request->query('quantity')) {
                $query .= ' AND  p.quantity=' . "'" . $request->query('quantity') . "'";
            }
            if (null !== $request->query('product_name')) {
                $query .= ' AND status=' . "'" . $request->query('status') . "'";
            }
        }

        return DB::select($query);
    }
}
