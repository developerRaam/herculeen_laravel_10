<?php

namespace App\Http\Controllers\Catalog\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Product\Product;
use App\Models\Cart;
use App\Models\Catalog\Product\ProductPrice;
use App\Models\StockStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $data['carts'] = [];
        $data['total_amount'] = 0;
        $data['total_mrp'] = 0;
        $data['discount_on_mrp'] = 0;
        $cart_product = Cart::where('user_id', session('isUser'))->get();
        foreach ($cart_product as $cart) {
            $product = Product::leftJoin('product_prices', 'products.id', '=', 'product_prices.product_id')
                                        ->select('products.*', 'product_prices.price','product_prices.mrp')
                                        ->where('products.id', $cart->product_id)->first();
                                    // dd($product);
            $stock = StockStatus::where('id', $product->stock_status_id)->first();
            $data['carts'][] = [
                "product_id" => $cart->product_id,
                "user_id" => $cart->user_id,
                "product_name" => $product->product_name,
                "slug" => $product->slug,
                "image" => ($product->image) ? asset("image/cache/products").'/'.($cart->product_id .'/'. str_replace(".jpg",'',$product->image) .'_700x700.jpg') : asset('not-image-available.png'),
                "quantity" => $cart->quantity,
                "stock_status" => $stock->name ?? '',
                "price" => $product->price * $cart->quantity,
            ];
            if($product->stock_status_id == 3) {
                $data['total_amount'] = $data['total_amount'] + $product->price * $cart->quantity;
                $data['total_mrp'] = $data['total_mrp'] + $product->mrp * $cart->quantity;
                $data['discount_on_mrp'] = $data['discount_on_mrp'] + (($product->mrp * $cart->quantity) - ($product->price * $cart->quantity));
            }
        }
        $data['cart_total'] = $cart_product->count();
        return view('catalog.checkout.cart', $data);
    }

    public function addCart(Request $request){
        try{
            $data = $request->request;
            $user_id = $data->get('user_id') ?? null;
            $product_id = $data->get('product_id') ?? null;
            $quantity = $data->get('quantity') ?? 0;

            if($quantity <= 0 ){
                $array = [
                    "success" => false,
                    "message" => "The cart must be at least 1 quantity."
                ];
                return response()->json($array);
            }

            $carts = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
            if($carts){
                Cart::where('user_id', $user_id)->where('product_id', $product_id)->update([
                    "quantity" => $quantity,
                    "updated_at" => Carbon::now()
                ]);
                $product_price = ProductPrice::where('product_id', $product_id)->first();

                // get updated cart
                $total_amount = 0;
                $total_mrp = 0;
                $discount_on_mrp = 0;
                $cart_product = Cart::where('user_id', session('isUser'))->get();
                foreach ($cart_product as $cart) {
                    $product = Product::leftJoin('product_prices', 'products.id', '=', 'product_prices.product_id')
                                                ->select('products.*', 'product_prices.price','product_prices.mrp')
                                                ->where('products.id', $cart->product_id)->first();
                    if($product->stock_status_id == 3) {
                        $total_amount = $total_amount + $product->price * $cart->quantity;
                        $total_mrp = $total_mrp + $product->mrp * $cart->quantity;
                        $discount_on_mrp = $discount_on_mrp + (($product->mrp * $cart->quantity) - ($product->price * $cart->quantity));
                    }
                }

                $array = [
                    "success" => true,
                    "message" => "Updated Cart Successfully!",
                    "price" => $product_price->price * $quantity,
                    "total_amount" => $total_amount,
                    "total_mrp" => $total_mrp,
                    "discount_on_mrp" => $discount_on_mrp,
                ];
                return response()->json($array);
            }else{
                Cart::create([
                    "user_id" => $user_id,
                    "product_id" => $product_id,
                    "quantity" => $quantity,
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
            Cart::where('user_id', session('isUser'))->where('product_id', $product_id)->delete();
            return redirect()->route('catalog.cart')->with('success', 'Your "'.$product_name.'" has been successfully removed from the cart!');
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
