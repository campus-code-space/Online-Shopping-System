<?php

namespace App\Models;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    //
    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');

    }
    public function subscription(){
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

}
