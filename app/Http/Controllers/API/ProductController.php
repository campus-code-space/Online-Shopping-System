<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
           
        return response()->json([
            "status"=>1
        ]);
    }
    public function store(Request $request){
        $user = Auth::user();

        $product = Product::create([
            'name'=>$request->name,
            'product_image'=>$request->product_image,
            'price'=>$request->price,
            'stock_quantity'=>$request->stock_quantity,
            'final_price'=>$request->final_price,
            'sold'=>$request->sold,
            'vendor_id'=>$request->vendor_id,
            'sub_category_id'=>$request->sub_category_id
        ]);
        
        dd($product);
    }
}
