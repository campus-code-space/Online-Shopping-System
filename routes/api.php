<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

 Route::get('/',function(){
    return "API";
 });

 Route::post('/register',[AuthController::class,'register']);
 Route::post('/login',[AuthController::class,'login']);
Route::post('/verify-and-create-user', [AuthController::class, 'verifyAndCreateUser']);
 Route::post('/resendOtp', [AuthController::class, 'sendOtp']);
 Route::post('/products', [ProductController::class, 'store']);

 
Route::middleware(['auth:sanctum','ability:admin'])->group(function(){
    Route::get('/product',[ProductController::class,'index']);
});

Route::middleware(['auth:sanctum','ability:Vendor'])->group(function(){

   Route::post('/products',[ProductController::class,'store']);
   Route::get('/products',[ProductController::class,'index']);
   Route::get('/myproducts',[ProductController::class,'currentproduct']);

});


Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::get('sub-categories', [SubCategoryController::class, 'index']);
Route::get('sub-categories/{id}', [SubCategoryController::class, 'show']);

  
Route::get('/order',function(){
         return "This is some order for user";

})->middleware(['auth:sanctum','ability:User']);