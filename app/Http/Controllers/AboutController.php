<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $stats = [
            ['number' => '500+', 'label' => 'منتج متاح', 'icon' => 'fa-box'],
            ['number' => '15K+', 'label' => 'عميل سعيد', 'icon' => 'fa-users'],
            ['number' => '10+', 'label' => 'سنوات خبرة', 'icon' => 'fa-award'],
            ['number' => '24/7', 'label' => 'دعم فني', 'icon' => 'fa-headset'],
        ];

        $team = [
            [
                'name' => 'محمد أحمد',
                'role' => 'المدير التنفيذي',
                'image' => 'team1',
                'bio' => 'خبرة 15 عاماً في مجال التقنية والطابعات',
            ],
            [
                'name' => 'سارة علي',
                'role' => 'مديرة المبيعات',
                'image' => 'team2',
                'bio' => 'متخصصة في حلول الطباعة للشركات',
            ],
            [
                'name' => 'أحمد حسن',
                'role' => 'مدير الدعم الفني',
                'image' => 'team3',
                'bio' => 'مهندس صيانة معتمد من HP وCanon',
            ],
            [
                'name' => 'فاطمة محمود',
                'role' => 'مديرة التسويق',
                'image' => 'team4',
                'bio' => 'خبيرة في التسويق الرقمي والعلاقات العامة',
            ],
        ];

        $values = [
            [
                'title' => 'الجودة',
                'description' => 'نقدم فقط المنتجات الأصلية من أفضل العلامات التجارية العالمية',
                'icon' => 'fa-star',
            ],
            [
                'title' => 'الثقة',
                'description' => 'نبني علاقات طويلة الأمد مع عملائنا على أساس الشفافية والمصداقية',
                'icon' => 'fa-handshake',
            ],
            [
                'title' => 'الابتكار',
                'description' => 'نواكب أحدث التقنيات ونقدم حلولاً مبتكرة لاحتياجات عملائنا',
                'icon' => 'fa-lightbulb',
            ],
            [
                'title' => 'الدعم',
                'description' => 'فريق دعم فني متاح على مدار الساعة لمساعدتك في أي وقت',
                'icon' => 'fa-headset',
            ],
        ];

        return view('about.index', compact('stats', 'team', 'values'));
    }
}
