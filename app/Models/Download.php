<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'title', 'description', 'category', 'brand',
        'version', 'size', 'os', 'icon', 'image',
        'file_url', 'downloads', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'downloads' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
