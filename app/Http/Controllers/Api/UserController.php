<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser(){
        $getAllUser = User::get();

        if($getAllUser->count() > 0){
            return response()->json([
                'status' => true,
                'Users' => $getAllUser
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User Not Found',
            ],401);
        }
    }

    public function getUserById(Request $request){
        $getAllUser = User::where('id', $request->user_id)->get();

        if($getAllUser->count() > 0){
            return response()->json([
                'status' => true,
                'Users' => $getAllUser
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User Not Found',
            ],401);
        }
    }

    public function getUserByEmail(Request $request){
        $getAllUser = User::where('email', $request->email)->get();

        if($getAllUser->count() > 0){
            return response()->json([
                'status' => true,
                'Users' => $getAllUser
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User Not Found',
            ],401);
        }
    }
}
