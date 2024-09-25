<?php

namespace App\Models\Admin\Storefront\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductVariation extends Model
{
    use HasFactory;

    protected $table = 'product_variation';

    protected $fillable = ['color_id', 'size_id', 'combination', 'price', 'quantity'];

    public static function addVariation($data = array()){

        foreach ($data as $value) {

            $getVariation = DB::table('product_variation')->where('product_id', $value['product_id'])->where('combination', $value['combination'])->first();

            if($getVariation){
                DB::table('product_variation')->where('id', $getVariation->id)->update([
                    'color_id' => $value['color_id'] ?? null ,
                    'size_id' => $value['size_id'] ?? null,
                    'price' => $value['price'] ?? null,
                    'quantity' => $value['quantity'] ?? 0,
                    'updated_at' => now(),
                ]);
            }else{
                DB::table('product_variation')->insert([
                    'product_id' => $value['product_id'],
                    'color_id' => $value['color_id'] ?? null,
                    'size_id' => $value['size_id'] ?? null,
                    'combination' => $value['combination'] ?? null,
                    'price' => $value['price'] ?? null,
                    'quantity' => $value['quantity'] ?? 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

        }
    }

    public static function getVariation($product_id){
        $getVariation = DB::table('product_variation')->where('product_id', $product_id)->get();

        $collection = [];

        foreach ($getVariation as $value) {
            $getColor = DB::table('colors')->where('id', $value->color_id)->first();
            $getSize = DB::table('size')->where('id', $value->size_id)->first();

            $collection[] = [
                'id' => $value->id ?? null,
                'color_id' => $value->color_id ?? null,
                'size_id' => $value->size_id ?? null,
                'combination' => $value->combination ?? null,
                'price' => intval($value->price) ?? null,
                'quantity' => $value->quantity ?? 0,
                'color_name' => $getColor->color_name ?? null,
                'size_name' => $getSize->size_name ?? null,
                'created_at' => $value->created_at ?? null,
                'updated_at' => $value->updated_at ?? null,
                'product_id' => $product_id ?? null
            ];
        }
        return $collection;
    }
}
