<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller{

    public function index(){
        $data['social'] = DB::table('social_medias')->first();
        $data['address'] = DB::table("address")->first();
        $data['setting'] = DB::table("settings")->first();

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

        return view('admin.setting.setting',$data);
    }

    public function saveSetting(Request $request){
        try{
            $social = DB::table('social_medias')->first();
            $setting = DB::table("settings")->first();
            $address = DB::table("address")->first();

            $data = $request->all();

            // address status
            $address_status = isset($data['address_status']) ? 1 : 0 ;
            $mobile_status = isset($data['mobile_status']) ? 1 : 0 ;
            $whatsapp_number_status = isset($data['whatsapp_number_status']) ? 1 : 0 ;
            $email_status = isset($data['email_status']) ? 1 : 0 ;
            $website_status = isset($data['website_status']) ? 1 : 0 ;  
            
            //social media status
            $social_status = isset($data['social_status']) ? 1 : 0 ;           

            // Address
            if($address){
                DB::update("UPDATE address set 
                address = '".$data['address'] ."',
                embed_url = '".$data['embed_url'] ."',
                mobile = '".(int)$data['mobile'] ."',
                whatsapp_number = '".(int)$data['whatsapp_number'] ."',
                website = '".$data['website'] ."',
                email = '".$data['email'] ."',
                address_status = '".$address_status."',
                mobile_status = '".$mobile_status ."',
                whatsapp_number_status = '".$whatsapp_number_status."',
                email_status = '".$email_status."',
                website_status = '".$website_status."'
                WHERE id = '".$address->id."'
            ");
            }else{
                DB::insert("INSERT into address set 
                address = '".$data['address'] ."',
                embed_url = '".$data['embed_url'] ."',
                mobile = '".(int)$data['mobile'] ."',
                whatsapp_number = '".(int)$data['whatsapp_number'] ."',
                email = '".$data['email'] ."',
                website = '".$data['website'] ."',
                address_status = '".$address_status."',
                mobile_status = '".$mobile_status ."',
                whatsapp_number_status = '".$whatsapp_number_status."',
                email_status = '".$email_status."',
                website_status = '".$website_status."'
            "); 
            }

            // Settings
            if($setting){
                DB::update("UPDATE settings set 
                site_name = '".$data['site_name'] ."',
                site_description = '".$data['site_description'] ."',
                logo = '".$data['logo'] ."' WHERE id = '".$setting->id."'
            ");
            }else{
                DB::insert("INSERT into settings set 
                site_name = '".$data['site_name'] ."',
                site_description = '".$data['site_description'] ."',
                logo = '".$data['logo'] ."'
            ");
            }

            // Social Media
            if($social){
                DB::update("UPDATE social_medias set 
                    instagram = '".$data['instagram'] ."',
                    facebook = '".$data['facebook'] ."',
                    youtube = '".$data['youtube'] ."',
                    status = '".$social_status."' WHERE id = '".$social->id."'
                ");
            }else{
                DB::insert("INSERT into social_medias set 
                    instagram = '".$data['instagram'] ."',
                    facebook = '".$data['facebook'] ."',
                    youtube = '".$data['youtube'] ."',
                    status = '".$social_status."'
                ");
            }

            return redirect('admin/setting')->with('success', 'Information saved successfully.');
        }catch(\Exception $e){
            return redirect('admin/setting')->with('error', $e);
        }
    }
}
