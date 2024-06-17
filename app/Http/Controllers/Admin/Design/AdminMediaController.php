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

    public function uploadFile(Request $request){
         
        $folderPath = public_path('image/uploads');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        
        if($request->hasFile('files')){
            $files = $request->file('files'); // get files
            
            foreach ($files as $key => $file) {               
                $imageName = $file->getClientOriginalName();
                $imagePath = public_path('image/uploads/') . $imageName ;
    
                if (!file_exists($imagePath)) {
                    // Move the file to the desired location
                    $file->move(public_path('image/uploads'), $imageName);
                }
            }
            $array = [
                'error' => 0,
                'message' => 'Files uploaded successfully'
            ];
            return response()->json($array, 200);
        }
        $array = [
            'error' => 1,
            'message' => 'No files found in request'
        ];
        return response()->json($array, 400);
    }

    public function getFiles(){
        $folderPath = public_path('image/uploads');

        if (!file_exists($folderPath)) {
            return response()->json(['error' => 'Directory does not exist'], 404);
        }

        $files = scandir($folderPath);
        $files = array_diff($files, array('.', '..'));

        $fileArray = [];

        foreach ($files as $file) {
            $file = URL::to('image/uploads/'.$file);
            array_push( $fileArray,$file);
        }

        return response()->json(($fileArray));
    }
}
