<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set locale from session
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        // Share active category TREE with frontend views (roots → children → grandchildren).
        // Cached for 1 hour; invalidated by CacheService::clearCategoryCaches().
        View::composer(['layouts.app', 'home', 'products.*', 'blog.*', 'about.*', 'news.*', 'contact.*', 'cart.*', 'checkout.*', 'auth.*', 'downloads.*', 'testimonials.*'], function ($view) {
            try {
                $navCategories = \Illuminate\Support\Facades\Cache::remember('active_categories', 3600, function () {
                    // Load only root-level active categories with their active children (2 levels deep)
                    return Category::with(['children' => function ($q) {
                            $q->active()
                              ->orderBy('sort_order')
                              ->orderBy('name_ar')
                              ->with(['children' => function ($q2) {
                                  $q2->active()
                                     ->orderBy('sort_order')
                                     ->orderBy('name_ar');
                              }]);
                        }])
                        ->active()
                        ->whereNull('parent_id')
                        ->select(['id', 'slug', 'name_ar', 'name_en', 'icon', 'image', 'is_active', 'parent_id', 'sort_order'])
                        ->orderBy('sort_order')
                        ->orderBy('name_ar')
                        ->get();
                });
                $view->with('navCategories', $navCategories);
            } catch (\Exception $e) {
                $view->with('navCategories', collect());
            }
        });
    }
}
