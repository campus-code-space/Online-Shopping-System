<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\SubscriptionItem;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends Controller
{
    //
    public function show(Request $request){

        $user = Auth::user();
           
        $subscription = Subscription::create([
            'vendor_id'=>$user->id,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'total_price'=>$request->total_price,
        ]);
        $items  = $request->subscriptionItems;

        foreach($items as $item){
            $subscription->subscriptionItems()->create($item);
        }  

        return response()->json([
            "status"=>1,
            "message"=>"Subscription posted succesfully"
        ]);
    }
    public function index(){

    }
}
