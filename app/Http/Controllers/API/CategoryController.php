<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('subCategories')->get();
    }

    public function show($id)
    {
        return Category::with('subCategories')->findOrFail($id);
    }
}