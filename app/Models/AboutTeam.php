<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutTeam extends Model
{
    protected $table = 'about_team';

    protected $fillable = ['name', 'role', 'role_ar', 'bio', 'bio_ar', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort_order'); }

    public function getLocalRole(): string
    {
        return (app()->getLocale() === 'ar' && $this->role_ar) ? $this->role_ar : $this->role;
    }

    public function getLocalBio(): string
    {
        return (app()->getLocale() === 'ar' && $this->bio_ar) ? $this->bio_ar : ($this->bio ?? '');
    }
}
