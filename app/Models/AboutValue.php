<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutValue extends Model
{
    protected $table = 'about_values';

    protected $fillable = ['title', 'title_ar', 'description', 'description_ar', 'icon', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort_order'); }

    public function getLocalTitle(): string
    {
        return (app()->getLocale() === 'ar' && $this->title_ar) ? $this->title_ar : $this->title;
    }

    public function getLocalDescription(): string
    {
        return (app()->getLocale() === 'ar' && $this->description_ar) ? $this->description_ar : $this->description;
    }
}
