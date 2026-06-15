<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['slug', 'name_ar', 'name_en', 'icon', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
 
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'slug');
    }
}
