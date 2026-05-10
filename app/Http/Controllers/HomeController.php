<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()
            ->featured()
            ->latest()
            ->take(6)
            ->get()
            ->map(fn($p) => [
                'id'          => $p->id,
                'name'        => $p->name,
                'category'    => $p->category,
                'price'       => $p->price,
                'old_price'   => $p->old_price,
                'badge'       => $p->badge,
                'badge_color' => $p->badge_color,
                'image'       => $p->image ?? 'product-1',
                'rating'      => $p->rating,
                'reviews'     => $p->reviews,
                'description' => $p->description,
            ])
            ->toArray();

        if (empty($featuredProducts)) {
            $featuredProducts = Product::active()
                ->latest()
                ->take(6)
                ->get()
                ->map(fn($p) => [
                    'id'          => $p->id,
                    'name'        => $p->name,
                    'category'    => $p->category,
                    'price'       => $p->price,
                    'old_price'   => $p->old_price,
                    'badge'       => $p->badge,
                    'badge_color' => $p->badge_color,
                    'image'       => $p->image ?? 'product-1',
                    'rating'      => $p->rating,
                    'reviews'     => $p->reviews,
                    'description' => $p->description,
                ])
                ->toArray();
        }

        $productCount = Product::where('is_active', true)->count();

        $stats = [
            ['number' => $productCount . '+', 'label' => 'منتج متاح',  'icon' => 'fa-box'],
            ['number' => '15K+',              'label' => 'عميل سعيد',  'icon' => 'fa-users'],
            ['number' => '10+',               'label' => 'سنوات خبرة', 'icon' => 'fa-award'],
            ['number' => '24/7',              'label' => 'دعم فني',    'icon' => 'fa-headset'],
        ];

        return view('home', compact('featuredProducts', 'stats'));
    }
}
