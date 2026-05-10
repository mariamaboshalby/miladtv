<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = [
            [
                'id' => 1,
                'name' => 'طابعة HP LaserJet Pro M404n',
                'category' => 'printers',
                'price' => 2499,
                'old_price' => 2999,
                'badge' => 'الأكثر مبيعاً',
                'badge_color' => 'blue',
                'image' => 'printer1',
                'rating' => 5,
                'reviews' => 128,
                'description' => 'طابعة ليزر احترافية بسرعة 40 صفحة/دقيقة',
            ],
            [
                'id' => 2,
                'name' => 'طابعة Canon PIXMA G3420',
                'category' => 'printers',
                'price' => 1899,
                'old_price' => null,
                'badge' => 'جديد',
                'badge_color' => 'green',
                'image' => 'printer2',
                'rating' => 4,
                'reviews' => 64,
                'description' => 'طابعة حبر ملونة لاسلكية مع خزان حبر كبير',
            ],
            [
                'id' => 3,
                'name' => 'ماوس Logitech MX Master 3',
                'category' => 'mice',
                'price' => 599,
                'old_price' => 749,
                'badge' => 'خصم 20%',
                'badge_color' => 'red',
                'image' => 'mouse1',
                'rating' => 5,
                'reviews' => 256,
                'description' => 'ماوس لاسلكي احترافي بتصميم مريح',
            ],
            [
                'id' => 4,
                'name' => 'سماعة Sony WH-1000XM5',
                'category' => 'headphones',
                'price' => 1299,
                'old_price' => 1599,
                'badge' => 'مميز',
                'badge_color' => 'purple',
                'image' => 'headphone1',
                'rating' => 5,
                'reviews' => 312,
                'description' => 'سماعة لاسلكية بخاصية إلغاء الضوضاء',
            ],
            [
                'id' => 5,
                'name' => 'فلاشة SanDisk Ultra 128GB',
                'category' => 'flash',
                'price' => 149,
                'old_price' => null,
                'badge' => null,
                'badge_color' => null,
                'image' => 'flash1',
                'rating' => 4,
                'reviews' => 89,
                'description' => 'فلاشة USB 3.0 بسرعة نقل 130MB/s',
            ],
            [
                'id' => 6,
                'name' => 'طابعة Epson EcoTank L3250',
                'category' => 'printers',
                'price' => 2199,
                'old_price' => 2499,
                'badge' => 'توفير',
                'badge_color' => 'orange',
                'image' => 'printer3',
                'rating' => 4,
                'reviews' => 97,
                'description' => 'طابعة حبر اقتصادية مع واي فاي مدمج',
            ],
        ];

        $stats = [
            ['number' => '500+', 'label' => 'منتج متاح', 'icon' => 'fa-box'],
            ['number' => '15K+', 'label' => 'عميل سعيد', 'icon' => 'fa-users'],
            ['number' => '10+', 'label' => 'سنوات خبرة', 'icon' => 'fa-award'],
            ['number' => '24/7', 'label' => 'دعم فني', 'icon' => 'fa-headset'],
        ];

        return view('home', compact('featuredProducts', 'stats'));
    }
}
