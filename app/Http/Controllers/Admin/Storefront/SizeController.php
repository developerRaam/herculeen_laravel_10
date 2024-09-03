<?php

namespace App\Http\Controllers\Admin\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Admin\Storefront\Size\Size;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SizeController extends Controller
{
    public function index(){
        $data['heading_title'] = "Size";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Size',
            'href' => URL::to('/admin/storefront/size')
        ];

        $data['add'] = URL::to('/admin/storefront/size-form');

        $data['Sizes'] = Size::getAllSize();

        return view('admin.storefront.size', $data);
    }

    public function form(){
        $data['heading_title'] = "Size";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Add Size',
            'href' => URL::to('/admin/storefront/size-form')
        ];

        $data['action'] = Route('save-size');
        $data['back'] = URL::to('/admin/storefront/size-form');

        return view('admin.storefront.size_form', $data);
    }

    public function save(Request $request){
        $data = $request->request;

        $validatedData = $request->validate([
            'size_name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        try{
            $array = array(
                'size_name' => $data->get('size_name'),
                'sort' => $data->get('sort_order')
            );

            $size = Size::addSize($array);

            if($size){
                return redirect('admin/storefront/size')->with('success', 'Size added successfully.');
            }else{
                return redirect('admin/storefront/size')->with('error', 'Size not added successfully.');
            }

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){
        
    }
}
