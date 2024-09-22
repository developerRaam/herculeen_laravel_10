<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller{

    public function index(){

        $data['heading_title'] = "Settings";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
			'text' => 'Setting',
			'href' => URL::to('/admin/setting')
		];

        $data['ecommerce_links'] = route('ecommerce-links');
        $data['site_url'] = route('site');

        return view('admin.setting.setting',$data);
    }
}
