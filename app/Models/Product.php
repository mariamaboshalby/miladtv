<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category',
        'description',
        'price',
        'old_price',
        'image',
        'stock',
        'badge',
        'badge_color',
        'rating',
        'reviews',
        'specs',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'stock' => 'integer',
        'rating' => 'integer',
        'reviews' => 'integer',
        'specs' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
