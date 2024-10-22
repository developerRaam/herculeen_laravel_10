<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting\Setting;
use Illuminate\Http\Request;
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

        $data['apiKey'] = app('settings')['api_apiKey'] ?? '';
        $data['apiPassword'] = app('settings')['api_apiPassword'] ?? '';
        $data['api_status'] = app('settings')['api_status'] ?? 0;

        return view('admin.setting.api',$data);
    }

    public function save(Request $request){
        try{
            Setting::editSetting('api', $request->all());
            
            return redirect()->route('api')->with('success', 'Configuration saved successfully.');
        }catch(\Exception $e){
            return redirect()->route('api')->with('error', $e->getMessage());
        }
    }
}
