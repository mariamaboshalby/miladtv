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

        return view('home', compact('featuredProducts', 'stats', 'blogPosts', 'downloads', 'testimonials'));
    }
}
