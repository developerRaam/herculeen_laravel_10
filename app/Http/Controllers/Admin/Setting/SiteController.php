<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;

class SiteController extends Controller
{
    public function index(){
        $data['heading_title'] = "Site";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
			'text' => 'Site',
			'href' => URL::to('/admin/setting/site')
		];

        $data['action'] = route('site-save');

        $data['site_logo'] = app('settings')['site_logo'] ?? '';
        $data['site_title'] = app('settings')['site_title'] ?? '';
        $data['site_description'] = app('settings')['site_description'] ?? '';

        return view('admin.setting.site',$data);
    }

    public function save(Request $request){
        try{
            $data = $request->all();
            // Upload image
            $file = $request->file('site_logo'); // get files
            $site_logo = app('settings')['site_logo'] ?? '';
            $folderPath = public_path('image/setting/site');

            if(null !== $file){
                $imageName = $file->getClientOriginalName();
                $imagePath = $folderPath . '/' . $imageName;

                // Check if folder exists, create if not
                if (!File::exists($folderPath)) {
                    File::makeDirectory($folderPath, 0777, true);
                }

               // Check if the existing logo needs to be removed
                if (isset($site_logo) && File::exists($folderPath . '/' . $site_logo)) {
                    File::delete($folderPath . '/' . $site_logo);
                }

                // Move the new file if it doesn't already exist
                if (!File::exists($imagePath)) {
                    $file->move($folderPath .'/', $imageName);
                }
                  // Get all the form data
                $data = array_merge($request->all(), ['site_logo' => $imageName]);
            }else{
                $data = array_merge($request->all(), ['site_logo' => NULL]);
            }

            Setting::editSetting('site', $data);
            
            return redirect('admin/setting')->with('success', 'Configuration saved successfully.');
        }catch(\Exception $e){
            return redirect('admin/setting')->with('error', $e->getMessage());
        }
    }
}
