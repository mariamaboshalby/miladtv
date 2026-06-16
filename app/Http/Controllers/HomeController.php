<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $mapProduct = fn($p) => [
            'id'          => $p->id,
            'name'        => $p->name,
            'category'    => $p->category,
            'price'       => $p->price,
            'old_price'   => $p->old_price,
            'badge'       => $p->badge,
            'badge_color' => $p->badge_color,
            'image_url'   => $p->getFirstMediaUrl('product-images', 'card'),
            'image'       => $p->getFirstMediaUrl('product-images', 'card'),
            'rating'      => $p->rating,
            'reviews'     => $p->reviews ?? 0,
            'description' => $p->description,
        ];

        $featuredProducts = Product::active()
            ->featured()
            ->with('media')
            ->latest()
            ->take(6)
            ->get()
            ->map($mapProduct)
            ->toArray();

        if (empty($featuredProducts)) {
            $featuredProducts = Product::active()
                ->with('media')
                ->latest()
                ->take(6)
                ->get()
                ->map($mapProduct)
                ->toArray();
        }

        $productCount = Product::where('is_active', true)->count();

        // Dynamically fetch About Stats
        $aboutStats = \App\Models\AboutStat::active()->take(4)->get();
        if ($aboutStats->count() > 0) {
            $stats = $aboutStats->map(function($stat) {
                return [
                    'number' => $stat->number,
                    'label'  => app()->getLocale() === 'ar' ? $stat->title_ar : $stat->title_en,
                    'icon'   => $stat->icon,
                ];
            })->toArray();
        } else {
            $stats = [
                ['number' => $productCount . '+', 'label' => 'منتج متاح',  'icon' => 'fa-box'],
                ['number' => '15K+',              'label' => 'عميل سعيد',  'icon' => 'fa-users'],
                ['number' => '10+',               'label' => 'سنوات خبرة', 'icon' => 'fa-award'],
                ['number' => '24/7',              'label' => 'دعم فني',    'icon' => 'fa-headset'],
            ];
        }

        // Dynamically fetch Blog Posts
        $blogPosts = \App\Models\BlogPost::active()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Dynamically fetch latest Downloads
        $downloads = \App\Models\Download::active()
            ->latest()
            ->take(4)
            ->get();

        // Fetch approved testimonials
        $testimonials = \App\Models\Testimonial::approved()
            ->latest()
            ->take(6)
            ->get();

        // Fetch Best Selling Products
        $bestSellingProducts = Product::active()
            ->with('media')
            ->orderBy('sales_count', 'desc')
            ->take(6)
            ->get()
            ->map($mapProduct)
            ->toArray();

        // Fetch First 4 Categories
        $topCategories = \App\Models\Category::active()->take(4)->get();

        // Fetch Most Visited Products
        $mostVisitedProducts = Product::active()
            ->with('media')
            ->orderBy('views_count', 'desc')
            ->take(6)
            ->get()
            ->map($mapProduct)
            ->toArray();

        // Fetch Latest 5 Products
        $latestProducts = Product::active()
            ->with('media')
            ->latest()
            ->take(5)
            ->get()
            ->map($mapProduct)
            ->toArray();

        // Home Settings & New Sections
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        // Deal of the Day
        $dealProduct = null;
        if (($settings['home_show_deal'] ?? '0') == '1' && !empty($settings['home_deal_product_id'])) {
            $productModel = Product::with('media')->find($settings['home_deal_product_id']);
            if ($productModel) {
                $dealProduct = $mapProduct($productModel);
                $dealProduct['end_time'] = $settings['home_deal_end_time'] ?? null;
            }
        }

        // Brands
        $brands = [];
        if (($settings['home_show_brands'] ?? '0') == '1') {
            $brands = \App\Models\Brand::active()->get();
        }

        // FAQs
        $faqs = [];
        if (($settings['home_show_faq'] ?? '0') == '1') {
            $faqs = \App\Models\Faq::active()->orderBy('sort_order')->get();
        }

        // Recommended For You (Random for now)
        $recommendedProducts = [];
        if (($settings['home_show_recommended'] ?? '0') == '1') {
            $recommendedProducts = Product::active()->with('media')->inRandomOrder()->take(6)->get()->map($mapProduct)->toArray();
        }

        return view('home', compact(
            'featuredProducts', 'stats', 'blogPosts', 'downloads', 'testimonials',
            'bestSellingProducts', 'topCategories', 'mostVisitedProducts', 'latestProducts',
            'settings', 'dealProduct', 'brands', 'faqs', 'recommendedProducts'
        ));
    }
}
