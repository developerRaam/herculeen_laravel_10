<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ApiController extends Controller
{
    public function index(){
        $data['heading_title'] = "API";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
			'text' => 'Setting',
			'href' => URL::to('/admin/setting')
		];
        $data['breadcrumbs'][] = [
			'text' => 'API',
			'href' => URL::to('/admin/setting/api')
		];

        $data['action'] = route('api-save');

        $apiData = DB::table('api')->first();

        $data['apiKey'] = $apiData->api_key ?? '';
        $data['apiPassword'] = $apiData->api_password ?? '';
        $data['api_id'] = $apiData->id ?? '';
        $data['api_status'] = $apiData->api_status ?? 0;

        return view('admin.setting.api',$data);
    }

    public function save(Request $request){
        try{
            $api_id = $request->get('api_id') ?? '';
            $apiKey =  $request->get('apiKey') ?? '';
            $apiPassword =  $request->get('apiPassword') ?? '';
            $api_status =  $request->get('api_status')?? 0;
            $apiData = DB::table('api')->where('id', $api_id)->first();
            if($apiData){
                DB::table('api')->where('id', $api_id)->update([
                    "api_key" => $apiKey,
                    "api_password" => $apiPassword,
                    "api_status" => $api_status,
                    "updated_at" => now()
                ]);
            }else{
                DB::table('api')->insert([
                    "api_key" => $apiKey,
                    "api_password" => $apiPassword,
                    "api_status" => $api_status,
                    "created_at" => now(),
                    "updated_at" => now()
                ]);
            }
            
            return redirect()->route('api')->with('success', 'Configuration saved successfully.');
        }catch(\Exception $e){
            return redirect()->route('api')->with('error', $e->getMessage());
        }
    }
}
