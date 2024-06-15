<?php

namespace App\Http\Controllers\Admin\Design;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AdminMediaController extends Controller
{
    public function index(){
        $data['heading_title'] = "Image Manager";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
			'text' => 'Media',
			'href' => URL::to('/admin/media')
		];

        return view('admin.design.media',$data);
    }
}
