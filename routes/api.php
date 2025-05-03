<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\SubscriptionController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

 Route::get('/',function(){
    return "API";
 });

 Route::post('/register',[AuthController::class,'register']);
 Route::post('/login',[AuthController::class,'login']);

 
Route::middleware(['auth:sanctum','ability:admin'])->group(function(){
    Route::get('/product',[ProductController::class,'index']);
});

Route::middleware(['auth:sanctum','ability:Vendor'])->group(function(){

   Route::post('/products',[ProductController::class,'store']);
   Route::get('/products',[ProductController::class,'index']);
   Route::get('/myproducts',[ProductController::class,'currentproduct']);
   Route::post('/subscription',[SubscriptionController::class,'index']);
   

});

  
Route::get('/order',function(){
         return "This is some order for user";

})->middleware(['auth:sanctum','ability:User']);