<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutStat extends Model
{
    protected $table = 'about_stats';

    protected $fillable = ['number', 'label', 'label_ar', 'icon', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort_order'); }

    public function getLocalLabel(): string
    {
        return (app()->getLocale() === 'ar' && $this->label_ar) ? $this->label_ar : $this->label;
    }
}
