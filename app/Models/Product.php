<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'product_image', 
        'price', 
        'stock_quantity', 
        'expire_date', 
        'discount', 
        'final_price', 
        'description', 
        'sold', 
        'vendor_id', 
        'sub_category_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function subscriptionItems()
    {
        return $this->hasMany(SubscriptionItem::class, 'product_id');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }
}
