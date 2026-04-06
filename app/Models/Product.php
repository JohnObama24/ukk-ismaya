<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'discount', 'stock', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor for price after discount
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount > 0) {
            return $this->price * (1 - $this->discount / 100);
        }
        return $this->price;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    
    // Helper to get average rating
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
}
