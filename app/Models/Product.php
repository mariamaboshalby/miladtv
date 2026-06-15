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
        'specs', 'is_active', 'is_featured',
    ];

    
    protected $casts = [
        'price'       => 'decimal:2',
        'old_price'   => 'decimal:2',
        'stock'       => 'integer',
        'rating'      => 'integer',
        'reviews'     => 'integer',
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

        // If a conversion is requested but doesn't exist yet, fall back to original
        if ($conversion !== '') {
            $conversionPath = $media->getPath($conversion);
            if (! file_exists($conversionPath)) {
                $conversion = '';
            }
        }

        $relativePath = $media->getPathRelativeToRoot($conversion);
        return '/storage/' . ltrim($relativePath, '/');
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
