<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Validate query parameters
        $validator = Validator::make($request->all(), [
            'sub_category_id' => 'nullable|exists:sub_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $query = Product::with(['sub_category', 'vendor'])->inRandomOrder();

        // Filter by subcategory if provided
        if ($request->has('sub_category_id')) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        
        $products = $query->get();

        return response()->json([
            'status' => 1,
            'message' => 'Products retrieved successfully',
            'data' => [
                'products' => $products,
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'sub_category_id' => 'required|integer|exists:sub_categories,id',
        'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/', 
        'stock_quantity' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'discount' => 'nullable|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/', 
        'product_image' => 'required|url',
        'expire_date' => 'nullable|date|after:today',
    ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculate final price
        $price = (float) $request->price;
        $discount = $request->discount ? (float) $request->discount : null;
        $finalPrice = $discount ? $price - $discount : $price;


        try {
            $product = Product::create([
                'name' => $request->name,
                'product_image' => $request->product_image, // Cloudinary URL
                'price' => $price,
                'stock_quantity' => $request->stock_quantity,
                'expire_date' => $request->expire_date,
                'discount' => $discount,
                'final_price' => $finalPrice,
                'description' => $request->description,
                'sold' => false,
                'vendor_id' => $user->id,
                'sub_category_id' => $request->sub_category_id,
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Product created successfully',
                'data' => $product->load(['sub_category', 'vendor'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to create product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::with(['sub_category', 'vendor'])->findOrFail($id);
            return response()->json([
                'status' => 1,
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Product not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function search(Request $request)
    {
        // Validate search query
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|min:1|max:255',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $queryString = $request->input('query');

        $query = Product::with(['sub_category', 'vendor'])
            ->where('name', 'LIKE', "%{$queryString}%")
            ->orWhere('description', 'LIKE', "%{$queryString}%")
            ->orWhereHas('sub_category', function ($q) use ($queryString) {
                $q->where('name', 'LIKE', "%{$queryString}%");
            });

        // Filter by subcategory if provided
        if ($request->has('sub_category_id')) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        $products = $query->get();

        return response()->json([
            'status' => 1,
            'message' => 'Search results retrieved successfully',
            'data' => [
                'products' => $products,
            ]
        ], 200);
    }

    public function vendorProducts()
    {
        $user = Auth::user();

        
        $products = Product::where('vendor_id', $user->id)
                           ->with(['sub_category'])
                           ->get();

        return response()->json([
            'status' => 1,
            'message' => 'Vendor products retrieved successfully',
            'data' => [
                'products' => $products
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        try {
            $product = Product::findOrFail($id);

            
            if ($user->role !== 'admin' && $product->vendor_id !== $user->id) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Unauthorized to update this product'
                ], 403);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'sub_category_id' => 'sometimes|integer|exists:sub_categories,id',
                'price' => 'sometimes|numeric|min:0',
                'stock_quantity' => 'sometimes|integer|min:0',
                'description' => 'nullable|string',
                'discount' => 'nullable|numeric|min:0',
                'product_image' => 'sometimes|url', // Cloudinary URL
                'expire_date' => 'nullable|date|after:today',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = [];
            if ($request->has('name')) {
                $data['name'] = $request->name;
            }
            if ($request->has('sub_category_id')) {
                $data['sub_category_id'] = $request->sub_category_id;
            }
            if ($request->has('price')) {
                $data['price'] = (float) $request->price;
            }
            if ($request->has('stock_quantity')) {
                $data['stock_quantity'] = $request->stock_quantity;
            }
            if ($request->has('description')) {
                $data['description'] = $request->description;
            }
            if ($request->has('discount')) {
                $data['discount'] = $request->discount ? (float) $request->discount : null;
            }
            if ($request->has('expire_date')) {
                $data['expire_date'] = $request->expire_date;
            }
            if ($request->has('product_image')) {
                $data['product_image'] = $request->product_image; 
            }

            if (isset($data['price'])) {
                $data['final_price'] = ($data['discount'] ?? $product->discount)
                    ? $data['price'] - ($data['discount'] ?? $product->discount)
                    : $data['price'];
            } elseif (isset($data['discount'])) {
                $data['final_price'] = $product->price - $data['discount'];
            }

            $product->update($data);

            return response()->json([
                'status' => 1,
                'message' => 'Product updated successfully',
                'data' => $product->load(['sub_category', 'vendor'])
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();

        try {
            $product = Product::findOrFail($id);

            if ($user->role !== 'admin' && $product->vendor_id !== $user->id) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Unauthorized to delete this product'
                ], 403);
            }

            $product->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 404);
        }
    }
} 