<?php

namespace App\Http\Controllers\Catalog\Checkout;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOption\None;

class CartController extends Controller
{
    public function index(){
        $data['carts'] = [];
        $cart_product = DB::table('cart')->where('customer_id', session('isCustomer'))->get();
        foreach ($cart_product as $cart) {
            $product = $product = DB::table('products')
                                        ->leftJoin('product_prices', 'products.id', '=', 'product_prices.product_id')
                                        ->select('products.*', 'product_prices.price','product_prices.mrp')
                                        ->where('products.id', $cart->product_id)->first();
            $stock = DB::table('stock_status')->where('id', $product->stock_status_id)->first();
            $data['carts'][] = [
                "product_id" => $cart->product_id,
                "customer_id" => $cart->customer_id,
                "product_name" => $product->product_name,
                "slug" => $product->slug,
                "image" => ($product->image) ? asset("image/cache/products").'/'.($cart->product_id .'/'. str_replace(".jpg",'',$product->image) .'_700x700.jpg') : asset('not-image-available.png'),
                "quantity" => $cart->quantity,
                "stock_status" => $stock->name ?? '',
                "price" => $product->price * $cart->quantity,
            ];
        }
        $data['total'] = $cart_product->count();
        return view('catalog.checkout.cart', $data);
    }

    public function addCart(Request $request){
        try{
            $data = $request->request;
            $customer_id = $data->get('customer_id') ?? null;
            $product_id = $data->get('product_id') ?? null;
            $quantity = $data->get('quantity') ?? 0;

            if($quantity <= 0 ){
                $array = [
                    "success" => false,
                    "message" => "The cart must be at least 1 quantity."
                ];
                return response()->json($array);
            }

            $carts = DB::table('cart')->where('customer_id', $customer_id)->where('product_id', $product_id)->first();
            if($carts){
                DB::table('cart')->where('customer_id', $customer_id)->where('product_id', $product_id)->update([
                    "quantity" => $quantity,
                    "updated_at" => now()
                ]);
                $array = [
                    "success" => true,
                    "message" => "Updated Cart Successfully!"
                ];
                return response()->json($array);
            }else{
                DB::table('cart')->insert([
                    "customer_id" => $customer_id,
                    "product_id" => $product_id,
                    "quantity" => $quantity,
                    "created_at" => now(),
                    "updated_at" => now()
                ]);
                $array = [
                    "success" => true,
                    "message" => "Added Cart Successfully!"
                ];
                return response()->json($array);
            }
            
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function removeCartProduct($product_id, $product_name){
        try{
            DB::table('cart')->where('customer_id', session('isCustomer'))->where('product_id', $product_id)->delete();
            return redirect()->route('catalog.cart')->with('success', 'Your "'.$product_name.'" has been successfully removed from the cart!');
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function increaseQunatity(){
        try{

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function decreaseQunatity(){
        try{

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
