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

        // Share active categories with views using a composer to avoid querying during application boot, and cache it.
        // Only share with frontend views (not admin) to avoid unnecessary overhead.
        View::composer(['layouts.app', 'home', 'products.*', 'blog.*', 'about.*', 'news.*', 'contact.*', 'cart.*', 'checkout.*', 'auth.*', 'downloads.*', 'testimonials.*'], function ($view) {
            try {
                $navCategories = \Illuminate\Support\Facades\Cache::remember('active_categories', 3600, function () {
                    return Category::active()
                        ->select(['id', 'slug', 'name_ar', 'name_en', 'icon', 'image', 'is_active'])
                        ->get();
                });
                $view->with('navCategories', $navCategories);
            } catch (\Exception $e) {
                $view->with('navCategories', collect());
            }
        });
    }
}
