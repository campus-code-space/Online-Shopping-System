<?php

namespace App\Http\Controllers\API;

use Exception;
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

            try{

                $product = Product::create([
                    'name'=>$request->productName,
                    'product_image'=>$request->productImage,
                    'price'=>$request->productPrice,
                    'stock_quantity'=>$request->stock_quantity,
                    'final_price'=>$request->final_price,
                    'sold'=>0,
                    'vendor_id'=>$user->id,
                    'sub_category_id'=>1
                ]);
            }catch(Exception $e){
                return response(" {$e->getMessage()}",500);
            }
 
        return response()->json([
            'status'=>1,
            'message'=>"Product posted Succesfully",
        ]);
        dd($product);
    }
}
