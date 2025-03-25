<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date', 
        'end_date', 
        'next_delivery_date', 
        'frequency', 
        'total_price', 
        'status', 
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function subscriptionItems()
    {
        return $this->hasMany(SubscriptionItem::class);
    }
}
