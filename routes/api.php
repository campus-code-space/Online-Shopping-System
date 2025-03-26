<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
 Route::get('/',function(){
    return "API";
 });

 Route::post('/register',[AuthController::class,'register']);
 Route::post('/login',[AuthController::class,'login']);

 Route::middleware("auth:sanctum")->group(function(){
    Route::resource('product',ProductController::class);
});