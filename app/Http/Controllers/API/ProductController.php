<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index(){
        
        $user = Auth::user();

        // dd($user->tokenCan('admin'));
        
        return response()->json([
            "status"=>1
        ]);
    }
}
