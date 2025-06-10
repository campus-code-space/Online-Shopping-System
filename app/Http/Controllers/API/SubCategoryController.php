<?php

namespace App\Http\Controllers\API;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        return SubCategory::with('category')->get();
    }

    public function show($id)
    {
        return SubCategory::with('category')->findOrFail($id);
    }
}