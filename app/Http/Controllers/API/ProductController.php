<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        return response()->json(Product::with(['subCategory', 'vendor'])->get(), 200);
    }

    // Store a new product
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'product_image' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'expire_date' => 'nullable|date',
            'discount' => 'nullable|numeric',
            'final_price' => 'required|numeric',
            'description' => 'nullable|string',
            'vendor_id' => 'required|exists:users,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    // Show a specific product
    public function show($id)
    {
        $product = Product::with(['subCategory', 'vendor'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->all());

        return response()->json($product, 200);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }
}
