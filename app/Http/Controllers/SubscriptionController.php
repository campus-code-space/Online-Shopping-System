<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends Controller
{
    //
    public function index(Request $request){

        $user = Auth::user();

    
        Subscription::create([
                'vendor_id'=>1,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'total_price'=>$request->total_price,
        ]);

        return response()->json([
            "user id"=>$user->id
        ]);
    }
}
