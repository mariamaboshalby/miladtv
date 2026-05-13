<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $stats = [
            ['number' => '500+', 'label' => 'Products Available', 'icon' => 'fa-box'],
            ['number' => '15K+', 'label' => 'Happy Customers', 'icon' => 'fa-users'],
            ['number' => '10+', 'label' => 'Years of Experience', 'icon' => 'fa-award'],
            ['number' => '24/7', 'label' => 'Tech Support', 'icon' => 'fa-headset'],
        ];

        $team = [
            [
                'name' => 'محمد أحمد',
                'role' => 'CEO',
                'image' => 'team1',
                'bio' => '15 years of experience in tech and printers',
            ],
            [
                'name' => 'سارة علي',
                'role' => 'Sales Manager',
                'image' => 'team2',
                'bio' => 'Specialist in corporate printing solutions',
            ],
            [
                'name' => 'أحمد حسن',
                'role' => 'Technical Support Manager',
                'image' => 'team3',
                'bio' => 'HP and Canon certified maintenance engineer',
            ],
            [
                'name' => 'فاطمة محمود',
                'role' => 'Marketing Manager',
                'image' => 'team4',
                'bio' => 'Expert in digital marketing and public relations',
            ],
        ];

        $values = [
            [
                'title' => 'Quality',
                'description' => 'We only offer genuine products from the world\'s top brands.',
                'icon' => 'fa-star',
            ],
            [
                'title' => 'Trust',
                'description' => 'We build long-term relationships grounded in transparency and integrity.',
                'icon' => 'fa-handshake',
            ],
            [
                'title' => 'Innovation',
                'description' => 'We stay ahead of the curve and bring cutting-edge solutions to our customers.',
                'icon' => 'fa-lightbulb',
            ],
            [
                'title' => 'Support',
                'description' => 'Our technical team is available around the clock to help you whenever you need.',
                'icon' => 'fa-headset',
            ],
        ];

        return view('about.index', compact('stats', 'team', 'values'));
    }
}
