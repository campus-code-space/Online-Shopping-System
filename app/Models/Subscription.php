<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date', 
        'end_date', 
        'next_delivery_date', 
        'total_price', 
        'vendor_id'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function user_subscription()
    {
        return $this->hasMany(UserSubscription::class, 'subscription_id');
    }

    public function subscriptionItems()
    {
        return $this->hasMany(SubscriptionItem::class,'subscription_items_id');
    }
}
