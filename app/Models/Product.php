<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'brand', 'category', 'description',
        'price', 'old_price', 'stock',
        'badge', 'badge_color', 'rating', 'reviews',
        'sales_count', 'views_count',
        'specs', 'is_active', 'is_featured',
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'old_price'   => 'decimal:2',
        'stock'       => 'integer',
        'rating'      => 'integer',
        'reviews'     => 'integer',
        'sales_count' => 'integer',
        'views_count' => 'integer',
        'specs'       => 'array',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    /* ── Media Collections ── */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-images')
             ->useFallbackUrl(asset('images/placeholder.png'))
             ->useFallbackPath(public_path('images/placeholder.png'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->width(400)
             ->height(400)
             ->sharpen(5);

        $this->addMediaConversion('card')
             ->width(800)
             ->height(800)
             ->sharpen(5);
    }

    /* ── Helpers ── */
    public function getMainImageUrl(string $conversion = ''): string
    {
        $media = $this->getFirstMedia('product-images');
        if (! $media) {
            return '';
        }

        if ($conversion && file_exists($media->getPath($conversion))) {
            return '/storage/' . ltrim($media->getPathRelativeToRoot($conversion), '/');
        }

        return '/storage/' . ltrim($media->getPathRelativeToRoot(''), '/');
    }

    /* ── Scopes ── */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /* ── Relations ── */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'slug');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
