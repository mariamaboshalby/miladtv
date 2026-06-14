<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title', 'title_ar',
        'excerpt', 'excerpt_ar',
        'content', 'content_ar',
        'category', 'author', 'author_role',
        'read_time', 'views', 'tags',
        'published_at', 'is_active',
    ];

    protected $casts = [
        'tags'         => 'array',
        'published_at' => 'date',
        'is_active'    => 'boolean',
        'read_time'    => 'integer',
        'views'        => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Return localised title */
    public function getLocalTitle(): string
    {
        $locale = app()->getLocale();
        return ($locale === 'ar' && $this->title_ar) ? $this->title_ar : $this->title;
    }

    public function getLocalExcerpt(): string
    {
        $locale = app()->getLocale();
        return ($locale === 'ar' && $this->excerpt_ar) ? $this->excerpt_ar : $this->excerpt;
    }

    public function getLocalContent(): string
    {
        $locale = app()->getLocale();
        return ($locale === 'ar' && $this->content_ar) ? $this->content_ar : $this->content;
    }
}
