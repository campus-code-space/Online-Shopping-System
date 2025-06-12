<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 
        'subscription_id', 
        'product_id',
        'product_name',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class,"subscription_id");
    }
}
