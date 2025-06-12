<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SubscriptionController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

 Route::get('/',function(){
    return "API";
 });

 Route::post('/register',[AuthController::class,'register']);
 Route::post('/login',[AuthController::class,'login']);
 Route::post('/verify', [AuthController::class, 'verifyAndCreateUser']);
 Route::post('/resendOtp', [AuthController::class, 'sendOtp']);

 
Route::middleware(['auth:sanctum','ability:admin'])->group(function(){
    Route::get('/product',[ProductController::class,'index']);
});

Route::middleware(['auth:sanctum','ability:Vendor'])->group(function(){

   Route::post('/products',[ProductController::class,'store']);
   Route::get('/products',[ProductController::class,'index']);
   Route::get('/myproducts',[ProductController::class,'currentproduct']);
   Route::get('/vendor/products', [ProductController::class, 'vendorProducts']);

});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']); 
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    
    // Cart routes
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/items', [CartController::class, 'addItem']);
    Route::put('/cart/items/{id}', [CartController::class, 'updateItem']);
    Route::delete('/cart/items/{id}', [CartController::class, 'removeItem']);
    
    // Order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    
    // Subscription routes
    Route::get('/subscriptions', [SubscriptionController::class, 'index']);
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show']);
    Route::put('/subscriptions/{id}', [SubscriptionController::class, 'update']);
    Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'destroy']);
    
    // Review routes
    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/reviews/{id}', [ReviewController::class, 'show']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
});


Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::get('sub-categories', [SubCategoryController::class, 'index']);
Route::get('sub-categories/{id}', [SubCategoryController::class, 'show']);

  
Route::get('/order',function(){
         return "This is some order for user";

})->middleware(['auth:sanctum','ability:User']);