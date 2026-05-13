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
            ['email' => 'admin@mjk.com'],
            [
                'name'      => 'مدير النظام',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'is_active' => true,
                'phone'     => '01234567890',
            ]
        );

        // ── Sample Users ─────────────────────────────────────────────
        $users = [
            ['name' => 'أحمد محمد',   'email' => 'ahmed@example.com',  'phone' => '01012345678'],
            ['name' => 'سارة علي',    'email' => 'sara@example.com',   'phone' => '01112345678'],
            ['name' => 'محمد حسن',    'email' => 'mohamed@example.com','phone' => '01212345678'],
            ['name' => 'فاطمة خالد',  'email' => 'fatma@example.com',  'phone' => '01512345678'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                array_merge($u, ['password' => Hash::make('password'), 'role' => 'user', 'is_active' => true])
            );
        }

        // ── Products ─────────────────────────────────────────────────
        $products = [
            // Printers
            [
                'name' => 'HP LaserJet Pro M404n',
                'brand' => 'HP', 'category' => 'printers',
                'price' => 2499, 'old_price' => 2999, 'stock' => 25,
                'badge' => 'Best Seller', 'badge_color' => 'blue',
                'rating' => 5, 'reviews' => 128, 'is_featured' => true,
                'description' => 'Monochrome laser printer at 40 ppm — ideal for small and medium offices.',
                'specs' => ['Speed: 40 ppm', 'Resolution: 1200 dpi', 'Connectivity: USB + Ethernet', 'Memory: 256MB'],
            ],
            [
                'name' => 'Canon PIXMA G3420',
                'brand' => 'Canon', 'category' => 'printers',
                'price' => 1899, 'old_price' => null, 'stock' => 18,
                'badge' => 'New', 'badge_color' => 'green',
                'rating' => 4, 'reviews' => 64, 'is_featured' => true,
                'description' => 'Wireless colour inkjet printer with a large ink tank for thousands of pages.',
                'specs' => ['Speed: 11 ppm', 'Resolution: 4800x1200 dpi', 'Connectivity: WiFi + USB', 'Ink Tank: 70ml'],
            ],
            [
                'name' => 'Epson EcoTank L3250',
                'brand' => 'Epson', 'category' => 'printers',
                'price' => 2199, 'old_price' => 2499, 'stock' => 12,
                'badge' => 'Save', 'badge_color' => 'orange',
                'rating' => 4, 'reviews' => 97, 'is_featured' => true,
                'description' => 'Economical inkjet printer with built-in WiFi and a large ink tank.',
                'specs' => ['Speed: 10 ppm', 'Resolution: 5760x1440 dpi', 'Connectivity: WiFi + USB', 'Ink Tank: 65ml'],
            ],
            [
                'name' => 'Brother HL-L2350DW',
                'brand' => 'Brother', 'category' => 'printers',
                'price' => 1799, 'old_price' => 2100, 'stock' => 8,
                'badge' => 'Sale', 'badge_color' => 'red',
                'rating' => 4, 'reviews' => 73, 'is_featured' => false,
                'description' => 'Compact wireless laser printer with automatic duplex printing.',
                'specs' => ['Speed: 32 ppm', 'Resolution: 2400 dpi', 'Connectivity: WiFi + USB', 'Duplex: Automatic'],
            ],
            [
                'name' => 'HP OfficeJet Pro 9015e',
                'brand' => 'HP', 'category' => 'printers',
                'price' => 3299, 'old_price' => null, 'stock' => 5,
                'badge' => 'Premium', 'badge_color' => 'purple',
                'rating' => 5, 'reviews' => 156, 'is_featured' => true,
                'description' => 'All-in-one printer (print, scan, copy, fax) with professional quality.',
                'specs' => ['Speed: 22 ppm', 'Resolution: 4800x1200 dpi', 'Connectivity: WiFi + Ethernet + USB', 'Functions: Print + Scan + Copy + Fax'],
            ],
            [
                'name' => 'Xerox B210',
                'brand' => 'Xerox', 'category' => 'printers',
                'price' => 2799, 'old_price' => 3200, 'stock' => 0,
                'badge' => null, 'badge_color' => null,
                'rating' => 4, 'reviews' => 41, 'is_featured' => false,
                'description' => 'High-speed monochrome laser printer with excellent print quality.',
                'specs' => ['Speed: 31 ppm', 'Resolution: 1200 dpi', 'Connectivity: WiFi + USB', 'Paper Capacity: 250 sheets'],
            ],
            // Mice
            [
                'name' => 'Logitech MX Master 3',
                'brand' => 'Logitech', 'category' => 'mice',
                'price' => 599, 'old_price' => 749, 'stock' => 30,
                'badge' => '20% Off', 'badge_color' => 'red',
                'rating' => 5, 'reviews' => 256, 'is_featured' => true,
                'description' => 'Professional wireless mouse with ergonomic design and smart scroll wheel.',
                'specs' => ['Connectivity: Bluetooth + USB', 'Battery: 70 days', 'DPI: 200–4000', 'Buttons: 7'],
            ],
            [
                'name' => 'Razer DeathAdder V3',
                'brand' => 'Razer', 'category' => 'mice',
                'price' => 449, 'old_price' => null, 'stock' => 22,
                'badge' => 'Gaming', 'badge_color' => 'green',
                'rating' => 5, 'reviews' => 189, 'is_featured' => false,
                'description' => 'Professional gaming mouse with lightweight design and high sensitivity.',
                'specs' => ['Connectivity: USB', 'DPI: 100–30000', 'Weight: 59g', 'Buttons: 5'],
            ],
            [
                'name' => 'Microsoft Arc Mouse',
                'brand' => 'Microsoft', 'category' => 'mice',
                'price' => 349, 'old_price' => 399, 'stock' => 15,
                'badge' => null, 'badge_color' => null,
                'rating' => 4, 'reviews' => 78, 'is_featured' => false,
                'description' => 'Innovative Bluetooth mouse with a foldable design.',
                'specs' => ['Connectivity: Bluetooth', 'Battery: 6 months', 'Design: Foldable', 'Compatibility: Windows + Mac'],
            ],
            // Headphones
            [
                'name' => 'Sony WH-1000XM5',
                'brand' => 'Sony', 'category' => 'headphones',
                'price' => 1299, 'old_price' => 1599, 'stock' => 14,
                'badge' => 'Premium', 'badge_color' => 'purple',
                'rating' => 5, 'reviews' => 312, 'is_featured' => true,
                'description' => 'Wireless headphones with industry-leading noise cancellation.',
                'specs' => ['Connectivity: Bluetooth 5.2', 'Battery: 30 hours', 'Noise Cancellation: Yes', 'Weight: 250g'],
            ],
            [
                'name' => 'JBL Tune 760NC',
                'brand' => 'JBL', 'category' => 'headphones',
                'price' => 699, 'old_price' => 899, 'stock' => 20,
                'badge' => 'Sale', 'badge_color' => 'red',
                'rating' => 4, 'reviews' => 145, 'is_featured' => false,
                'description' => 'Wireless headphones with JBL signature sound and noise cancellation.',
                'specs' => ['Connectivity: Bluetooth 5.0', 'Battery: 35 hours', 'Noise Cancellation: Yes', 'Weight: 222g'],
            ],
            [
                'name' => 'HyperX Cloud Alpha',
                'brand' => 'HyperX', 'category' => 'headphones',
                'price' => 549, 'old_price' => null, 'stock' => 9,
                'badge' => 'Gaming', 'badge_color' => 'green',
                'rating' => 5, 'reviews' => 203, 'is_featured' => false,
                'description' => 'Professional gaming headset with surround sound and detachable microphone.',
                'specs' => ['Connectivity: USB + 3.5mm', 'Audio: 7.1 Surround', 'Microphone: Detachable', 'Weight: 336g'],
            ],
            // Flash Drives
            [
                'name' => 'SanDisk Ultra 128GB',
                'brand' => 'SanDisk', 'category' => 'flash',
                'price' => 149, 'old_price' => null, 'stock' => 50,
                'badge' => null, 'badge_color' => null,
                'rating' => 4, 'reviews' => 89, 'is_featured' => false,
                'description' => 'USB 3.0 flash drive with 130MB/s transfer speed and 128GB capacity.',
                'specs' => ['Capacity: 128GB', 'Speed: 130MB/s', 'Connectivity: USB 3.0', 'Warranty: 5 years'],
            ],
            [
                'name' => 'Kingston DataTraveler 256GB',
                'brand' => 'Kingston', 'category' => 'flash',
                'price' => 249, 'old_price' => 299, 'stock' => 35,
                'badge' => 'Sale', 'badge_color' => 'red',
                'rating' => 4, 'reviews' => 56, 'is_featured' => false,
                'description' => 'USB 3.2 flash drive with 256GB capacity and high transfer speed.',
                'specs' => ['Capacity: 256GB', 'Speed: 200MB/s', 'Connectivity: USB 3.2', 'Warranty: Lifetime'],
            ],
            [
                'name' => 'Samsung BAR Plus 64GB',
                'brand' => 'Samsung', 'category' => 'flash',
                'price' => 99, 'old_price' => null, 'stock' => 60,
                'badge' => 'Value', 'badge_color' => 'blue',
                'rating' => 4, 'reviews' => 134, 'is_featured' => false,
                'description' => 'Sleek metal USB 3.1 flash drive with a durable build.',
                'specs' => ['Capacity: 64GB', 'Speed: 200MB/s', 'Connectivity: USB 3.1', 'Resistant: Water + Shock'],
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['name' => $p['name']],
                array_merge($p, ['is_active' => true])
            );
        }

        // ── Sample Orders ─────────────────────────────────────────────
        $statuses  = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $payments  = ['cash', 'card', 'transfer'];
        $payStatus = ['unpaid', 'paid', 'paid', 'paid', 'unpaid'];
        $cities    = ['القاهرة', 'الإسكندرية', 'الجيزة', 'المنصورة', 'أسيوط'];
        $names     = ['أحمد محمد', 'سارة علي', 'محمد حسن', 'فاطمة خالد', 'عمر إبراهيم'];

        $allProducts = Product::all();

        for ($i = 1; $i <= 20; $i++) {
            $statusIdx = array_rand($statuses);
            $order = Order::create([
                'order_number'     => 'MJK-' . strtoupper(substr(md5($i . time()), 0, 8)),
                'customer_name'    => $names[array_rand($names)],
                'customer_email'   => 'customer' . $i . '@example.com',
                'customer_phone'   => '010' . rand(10000000, 99999999),
                'customer_address' => 'شارع ' . rand(1, 100) . '، حي ' . rand(1, 20),
                'city'             => $cities[array_rand($cities)],
                'subtotal'         => 0,
                'shipping'         => rand(0, 1) ? 0 : 50,
                'total'            => 0,
                'status'           => $statuses[$statusIdx],
                'payment_method'   => $payments[array_rand($payments)],
                'payment_status'   => $payStatus[$statusIdx],
                'created_at'       => now()->subDays(rand(0, 30)),
            ]);

            $subtotal = 0;
            $itemCount = rand(1, 3);
            $pickedProducts = $allProducts->random(min($itemCount, $allProducts->count()));

            foreach ($pickedProducts as $product) {
                $qty   = rand(1, 3);
                $total = $product->price * $qty;
                $subtotal += $total;

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'price'        => $product->price,
                    'quantity'     => $qty,
                    'total'        => $total,
                ]);
            }

            $order->update([
                'subtotal' => $subtotal,
                'total'    => $subtotal + $order->shipping,
            ]);
        }
    }
}
