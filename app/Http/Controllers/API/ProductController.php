<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){


        return response()->json([
            "status"=>1,
            'product_list'=>Product::inRandomOrder()->limit(6)->get()
        ]);
    }
    public function store(Request $request){
        $user = Auth::user();

         $subCategoryId = SubCategory::where('name',$request->productSubCategory)->first();

         if(!$subCategoryId){
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        $desc = ($request->productDescription)?($request->productDescription):(null);
        $discount = ($request->discount)?((float)$request->discount):(null);

            try{

                $product = Product::create([
                    'name'=>$request->productName,
                    'product_image'=>$request->productImage,
                    'price'=>$request->productPrice,
                    'stock_quantity'=>$request->stock_quantity,
                    'discount'=>$discount,
                    'final_price'=>(float)$request->final_price,
                    'description'=>$desc,
                    'sold'=>0,
                    'vendor_id'=>$user->id,
                    'sub_category_id'=>$subCategoryId->id
                ]);
            }catch(Exception $e){
                return response(" {$e->getMessage()}",500);
            }
 
        return response()->json([
            'status'=>1,
            'message'=>"Product posted Succesfully",
        ]);
    }
    public function currentproduct(Request $request){

        $user = Auth::user();

        $products = Product::where('vendor_id',$user->id)->limit(6)->get();
        
        // return response()->json([
        //     'products' => Product::where('vendor_id',$user->id)->limit(6)->get()
        // ]);

        return response()->json([
            'status'=>1,
            "product_list"=>$products
        ]);
    }
}
