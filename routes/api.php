<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/signup', [AuthController::class, 'signUp']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getAllUser', [UserController::class, 'getAllUser']);
    Route::get('/getUserById', [UserController::class, 'getUserById']);
    Route::get('/getUserByEmail', [UserController::class, 'getUserByEmail']);

});
