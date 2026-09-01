<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    /**
     * Clear all homepage product & category caches
     */
    public static function clearProductCaches(): void
    {
        Cache::forget('home_featured_products');
        Cache::forget('home_best_selling_products');
        Cache::forget('home_most_visited_products');
        Cache::forget('home_latest_products');
        Cache::forget('home_recommended_products');

        // Clear products listing page cache (all categories + sort combos)
        static::clearProductsListingCaches();
    }

    /**
     * Clear all products listing page caches.
     * We use a cache tag pattern via a version key: bump the version
     * and all old keys become unreachable (lazy invalidation).
     *
     * Since we may not have Redis tags, we use a version counter approach.
     */
    public static function clearProductsListingCaches(): void
    {
        // Bump the products listing version — all cached pages will miss
        Cache::increment('products_listing_version');

        // Also clear common individual product show pages
        // (product IDs are unknown here, so we rely on the 5-min TTL for show pages)
    }

    /**
     * Clear cache for a specific product show page.
     */
    public static function clearProductShowCache(int $productId): void
    {
        Cache::forget("product_show:{$productId}");
    }

    /**
     * Clear category caches
     */
    public static function clearCategoryCaches(): void
    {
        Cache::forget('active_categories');
        Cache::forget('active_categories_list');
        Cache::forget('category_icon_map');
        Cache::forget('home_top_categories');
    }

    /**
     * Clear settings & content caches
     */
    public static function clearSettingsCaches(): void
    {
        Cache::forget('home_settings_map');
        Cache::forget('home_brands_list');
        Cache::forget('home_faqs_list');
        Cache::forget('home_blog_posts');
        Cache::forget('home_downloads');
        Cache::forget('home_testimonials');
        Cache::forget('home_stats_ar');
        Cache::forget('home_stats_en');
    }

    /**
     * Clear all public caches
     */
    public static function clearAllPublicCaches(): void
    {
        self::clearProductCaches();
        self::clearCategoryCaches();
        self::clearSettingsCaches();
    }
}
