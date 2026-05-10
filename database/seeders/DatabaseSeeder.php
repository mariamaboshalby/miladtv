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
            ['name' => 'طابعة HP LaserJet Pro M404n',    'brand' => 'HP',      'category' => 'printers',   'price' => 2499, 'old_price' => 2999, 'stock' => 25, 'badge' => 'الأكثر مبيعاً', 'badge_color' => 'blue',   'rating' => 5, 'reviews' => 128, 'is_featured' => true,  'description' => 'طابعة ليزر أحادية اللون بسرعة 40 صفحة/دقيقة، مثالية للمكاتب الصغيرة والمتوسطة.', 'specs' => ['السرعة: 40 صفحة/دقيقة','الدقة: 1200 dpi','الاتصال: USB + Ethernet','الذاكرة: 256MB']],
            ['name' => 'طابعة Canon PIXMA G3420',         'brand' => 'Canon',   'category' => 'printers',   'price' => 1899, 'old_price' => null,  'stock' => 18, 'badge' => 'جديد',          'badge_color' => 'green',  'rating' => 4, 'reviews' => 64,  'is_featured' => true,  'description' => 'طابعة حبر ملونة لاسلكية مع خزان حبر كبير يكفي لآلاف الصفحات.', 'specs' => ['السرعة: 11 صفحة/دقيقة','الدقة: 4800x1200 dpi','الاتصال: WiFi + USB','خزان الحبر: 70ml']],
            ['name' => 'طابعة Epson EcoTank L3250',       'brand' => 'Epson',   'category' => 'printers',   'price' => 2199, 'old_price' => 2499,  'stock' => 12, 'badge' => 'توفير',         'badge_color' => 'orange', 'rating' => 4, 'reviews' => 97,  'is_featured' => true,  'description' => 'طابعة حبر اقتصادية مع واي فاي مدمج وخزان حبر ضخم.', 'specs' => ['السرعة: 10 صفحة/دقيقة','الدقة: 5760x1440 dpi','الاتصال: WiFi + USB','خزان الحبر: 65ml']],
            ['name' => 'طابعة Brother HL-L2350DW',        'brand' => 'Brother', 'category' => 'printers',   'price' => 1799, 'old_price' => 2100,  'stock' => 8,  'badge' => 'خصم',           'badge_color' => 'red',    'rating' => 4, 'reviews' => 73,  'is_featured' => false, 'description' => 'طابعة ليزر لاسلكية مدمجة مع طباعة على الوجهين تلقائياً.', 'specs' => ['السرعة: 32 صفحة/دقيقة','الدقة: 2400 dpi','الاتصال: WiFi + USB','الطباعة: وجهين تلقائي']],
            ['name' => 'طابعة HP OfficeJet Pro 9015e',    'brand' => 'HP',      'category' => 'printers',   'price' => 3299, 'old_price' => null,  'stock' => 5,  'badge' => 'مميز',          'badge_color' => 'purple', 'rating' => 5, 'reviews' => 156, 'is_featured' => true,  'description' => 'طابعة متعددة الوظائف (طباعة، مسح، نسخ، فاكس) بجودة احترافية.', 'specs' => ['السرعة: 22 صفحة/دقيقة','الدقة: 4800x1200 dpi','الاتصال: WiFi + Ethernet + USB','الوظائف: طباعة + مسح + نسخ + فاكس']],
            ['name' => 'طابعة Xerox B210',                'brand' => 'Xerox',   'category' => 'printers',   'price' => 2799, 'old_price' => 3200,  'stock' => 0,  'badge' => null,            'badge_color' => null,     'rating' => 4, 'reviews' => 41,  'is_featured' => false, 'description' => 'طابعة ليزر أحادية اللون بسرعة عالية وجودة ممتازة.', 'specs' => ['السرعة: 31 صفحة/دقيقة','الدقة: 1200 dpi','الاتصال: WiFi + USB','سعة الورق: 250 ورقة']],
            // Mice
            ['name' => 'ماوس Logitech MX Master 3',       'brand' => 'Logitech',   'category' => 'mice',       'price' => 599,  'old_price' => 749,   'stock' => 30, 'badge' => 'خصم 20%',       'badge_color' => 'red',    'rating' => 5, 'reviews' => 256, 'is_featured' => true,  'description' => 'ماوس لاسلكي احترافي بتصميم مريح وعجلة تمرير ذكية.', 'specs' => ['الاتصال: Bluetooth + USB','البطارية: 70 يوم','الدقة: 200-4000 DPI','الأزرار: 7 أزرار']],
            ['name' => 'ماوس Razer DeathAdder V3',         'brand' => 'Razer',      'category' => 'mice',       'price' => 449,  'old_price' => null,  'stock' => 22, 'badge' => 'جيمينج',        'badge_color' => 'green',  'rating' => 5, 'reviews' => 189, 'is_featured' => false, 'description' => 'ماوس ألعاب احترافي بتصميم خفيف الوزن وحساسية عالية.', 'specs' => ['الاتصال: USB','الدقة: 100-30000 DPI','الوزن: 59g','الأزرار: 5 أزرار']],
            ['name' => 'ماوس Microsoft Arc Mouse',         'brand' => 'Microsoft',  'category' => 'mice',       'price' => 349,  'old_price' => 399,   'stock' => 15, 'badge' => null,            'badge_color' => null,     'rating' => 4, 'reviews' => 78,  'is_featured' => false, 'description' => 'ماوس بلوتوث بتصميم مبتكر قابل للطي.', 'specs' => ['الاتصال: Bluetooth','البطارية: 6 أشهر','التصميم: قابل للطي','التوافق: Windows + Mac']],
            // Headphones
            ['name' => 'سماعة Sony WH-1000XM5',           'brand' => 'Sony',       'category' => 'headphones', 'price' => 1299, 'old_price' => 1599,  'stock' => 14, 'badge' => 'مميز',          'badge_color' => 'purple', 'rating' => 5, 'reviews' => 312, 'is_featured' => true,  'description' => 'سماعة لاسلكية بخاصية إلغاء الضوضاء الرائدة في الصناعة.', 'specs' => ['الاتصال: Bluetooth 5.2','البطارية: 30 ساعة','إلغاء الضوضاء: نعم','الوزن: 250g']],
            ['name' => 'سماعة JBL Tune 760NC',             'brand' => 'JBL',        'category' => 'headphones', 'price' => 699,  'old_price' => 899,   'stock' => 20, 'badge' => 'خصم',           'badge_color' => 'red',    'rating' => 4, 'reviews' => 145, 'is_featured' => false, 'description' => 'سماعة لاسلكية بجودة صوت JBL الشهيرة وخاصية إلغاء الضوضاء.', 'specs' => ['الاتصال: Bluetooth 5.0','البطارية: 35 ساعة','إلغاء الضوضاء: نعم','الوزن: 222g']],
            ['name' => 'سماعة HyperX Cloud Alpha',         'brand' => 'HyperX',     'category' => 'headphones', 'price' => 549,  'old_price' => null,  'stock' => 9,  'badge' => 'جيمينج',        'badge_color' => 'green',  'rating' => 5, 'reviews' => 203, 'is_featured' => false, 'description' => 'سماعة ألعاب احترافية بصوت محيطي ومايكروفون قابل للفصل.', 'specs' => ['الاتصال: USB + 3.5mm','الصوت: 7.1 محيطي','المايكروفون: قابل للفصل','الوزن: 336g']],
            // Flash
            ['name' => 'فلاشة SanDisk Ultra 128GB',        'brand' => 'SanDisk',    'category' => 'flash',      'price' => 149,  'old_price' => null,  'stock' => 50, 'badge' => null,            'badge_color' => null,     'rating' => 4, 'reviews' => 89,  'is_featured' => false, 'description' => 'فلاشة USB 3.0 بسرعة نقل 130MB/s وسعة 128GB.', 'specs' => ['السعة: 128GB','السرعة: 130MB/s','الاتصال: USB 3.0','الضمان: 5 سنوات']],
            ['name' => 'فلاشة Kingston DataTraveler 256GB', 'brand' => 'Kingston',   'category' => 'flash',      'price' => 249,  'old_price' => 299,   'stock' => 35, 'badge' => 'خصم',           'badge_color' => 'red',    'rating' => 4, 'reviews' => 56,  'is_featured' => false, 'description' => 'فلاشة USB 3.2 بسعة 256GB وسرعة نقل عالية.', 'specs' => ['السعة: 256GB','السرعة: 200MB/s','الاتصال: USB 3.2','الضمان: مدى الحياة']],
            ['name' => 'فلاشة Samsung BAR Plus 64GB',       'brand' => 'Samsung',    'category' => 'flash',      'price' => 99,   'old_price' => null,  'stock' => 60, 'badge' => 'اقتصادي',       'badge_color' => 'blue',   'rating' => 4, 'reviews' => 134, 'is_featured' => false, 'description' => 'فلاشة معدنية أنيقة بسرعة USB 3.1 وتصميم متين.', 'specs' => ['السعة: 64GB','السرعة: 200MB/s','الاتصال: USB 3.1','المقاومة: ماء + صدمات']],
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
