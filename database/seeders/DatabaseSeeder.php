<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ──────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'      => 'مدير النظام',
                'password'  => Hash::make('12345678'),
                'role'      => 'admin',
                'is_active' => true,
                'phone'     => '01234567890',
            ]
        );

      
    }
}
