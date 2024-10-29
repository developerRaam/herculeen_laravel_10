<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Product\Product;
use App\Models\Api\ApiAuth;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\DB;

class ApiAuthController extends Controller
{
    public static function shartSession($apiKey, $apiPassword) {
        $api_apiKey = app('settings')['api_apiKey'] ?? '';
        $api_apiPassword = app('settings')['api_apiPassword'] ?? '';
        $api_status = app('settings')['api_status'];

        if (!$api_status) {
            return [
                "success" => false,
                "message" => "We are unable to start API session because API is disabled!"
            ];
        }

        if($api_apiKey == $apiKey && $api_apiPassword == $apiPassword){
            $token = bin2hex(random_bytes(32));
            session_start();
            $_SESSION['api_token'] = $token;
            return [
                "success" => true,
                // "api_token" => $_SESSION['api_token'],
                "message" => "API logged in successfully"
            ];
        }else{
            $array = [
                "success" => false,
                "message" => "Invalid API Key and Password!"
            ];
            return $array;
        }
    }

    public static function checkSession(){
        session_start();
        if(isset($_SESSION['api_token']) && $_SESSION['api_token']){
            $array = [
                "success" => true,
                "api_token" => $_SESSION['api_token']
            ];
            return $array;
        }
        
        return [
            "success" => false,
            "message" => "The API session has expired."
        ];
    }

    public function apiLogin(Request $request)
    {
        $apiKey = $request->get('apiKey');
        $apiPassword = $request->get('apiPassword');
        
        return response()->json($apiPassword);

        $startSession = self::shartSession($apiKey, $apiPassword);
        if($startSession['success']){
            return response()->json($startSession);
        }else{
            $array = [
                "success" => false,
                "message" => $startSession['message']
            ];
            return response()->json($array);
        }
    }

    public function getProducts(Request $request){
        $checkSession = self::checkSession();
        if(!$checkSession['success']){
            return response()->json($checkSession);
        }

        $product_json = [];

        $products = Product::getProducts();
        $product_json['total'] = collect($products)->count();
        foreach ($products as $product) {
            $product->image = url('image/cache/products/'. $product->product_id . '/' . str_replace('.jpg','', $product->image) .'_700x700.jpg');
            $product_images = DB::table('product_images')->where("product_id", $product->product_id)->get();
            
            // additional images
            $additional_images = [];
            foreach ($product_images as $product_image) {
                $additional_image = [
                    "1" => url('image/cache/products/'. $product_image->product_id . '/' . str_replace('.jpg','', $product_image->image) .'_100x100.jpg'),
                    "2" => url('image/cache/products/'. $product_image->product_id . '/' . str_replace('.jpg','', $product_image->image) .'_700x700.jpg')
                ];
                array_push($additional_images, $additional_image);
            }
            $product->images[] = $additional_images;

            $product_json['products'][] = $product;
        }
        return response()->json($product_json);
    }
}
