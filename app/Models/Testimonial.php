<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'email',
        'rating',
        'message',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'rating' => 'integer',
    ];

    // Scope for approved testimonials
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // Scope for recent testimonials
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
