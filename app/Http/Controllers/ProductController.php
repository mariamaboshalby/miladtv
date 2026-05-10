<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function getAllProducts()
    {
        return [
            // Printers
            ['id' => 1, 'name' => 'طابعة HP LaserJet Pro M404n', 'category' => 'printers', 'price' => 2499, 'old_price' => 2999, 'badge' => 'الأكثر مبيعاً', 'badge_color' => 'blue', 'image' => 'printer1', 'rating' => 5, 'reviews' => 128, 'description' => 'طابعة ليزر أحادية اللون بسرعة 40 صفحة/دقيقة، مثالية للمكاتب الصغيرة والمتوسطة. تدعم الطباعة عبر الشبكة وتتميز بجودة طباعة عالية.', 'brand' => 'HP', 'specs' => ['السرعة: 40 صفحة/دقيقة', 'الدقة: 1200 dpi', 'الاتصال: USB + Ethernet', 'الذاكرة: 256MB']],
            ['id' => 2, 'name' => 'طابعة Canon PIXMA G3420', 'category' => 'printers', 'price' => 1899, 'old_price' => null, 'badge' => 'جديد', 'badge_color' => 'green', 'image' => 'printer2', 'rating' => 4, 'reviews' => 64, 'description' => 'طابعة حبر ملونة لاسلكية مع خزان حبر كبير يكفي لآلاف الصفحات. مثالية للاستخدام المنزلي والمكتبي.', 'brand' => 'Canon', 'specs' => ['السرعة: 11 صفحة/دقيقة', 'الدقة: 4800x1200 dpi', 'الاتصال: WiFi + USB', 'خزان الحبر: 70ml']],
            ['id' => 3, 'name' => 'طابعة Epson EcoTank L3250', 'category' => 'printers', 'price' => 2199, 'old_price' => 2499, 'badge' => 'توفير', 'badge_color' => 'orange', 'image' => 'printer3', 'rating' => 4, 'reviews' => 97, 'description' => 'طابعة حبر اقتصادية مع واي فاي مدمج وخزان حبر ضخم. تكلفة طباعة منخفضة جداً مع جودة ممتازة.', 'brand' => 'Epson', 'specs' => ['السرعة: 10 صفحة/دقيقة', 'الدقة: 5760x1440 dpi', 'الاتصال: WiFi + USB', 'خزان الحبر: 65ml']],
            ['id' => 4, 'name' => 'طابعة Brother HL-L2350DW', 'category' => 'printers', 'price' => 1799, 'old_price' => 2100, 'badge' => 'خصم', 'badge_color' => 'red', 'image' => 'printer4', 'rating' => 4, 'reviews' => 73, 'description' => 'طابعة ليزر لاسلكية مدمجة مع طباعة على الوجهين تلقائياً. مثالية للمنازل والمكاتب الصغيرة.', 'brand' => 'Brother', 'specs' => ['السرعة: 32 صفحة/دقيقة', 'الدقة: 2400 dpi', 'الاتصال: WiFi + USB', 'الطباعة: وجهين تلقائي']],
            ['id' => 5, 'name' => 'طابعة HP OfficeJet Pro 9015e', 'category' => 'printers', 'price' => 3299, 'old_price' => null, 'badge' => 'مميز', 'badge_color' => 'purple', 'image' => 'printer5', 'rating' => 5, 'reviews' => 156, 'description' => 'طابعة متعددة الوظائف (طباعة، مسح، نسخ، فاكس) بجودة احترافية. مثالية للمكاتب المتوسطة والكبيرة.', 'brand' => 'HP', 'specs' => ['السرعة: 22 صفحة/دقيقة', 'الدقة: 4800x1200 dpi', 'الاتصال: WiFi + Ethernet + USB', 'الوظائف: طباعة + مسح + نسخ + فاكس']],
            ['id' => 6, 'name' => 'طابعة Xerox B210', 'category' => 'printers', 'price' => 2799, 'old_price' => 3200, 'badge' => null, 'badge_color' => null, 'image' => 'printer6', 'rating' => 4, 'reviews' => 41, 'description' => 'طابعة ليزر أحادية اللون بسرعة عالية وجودة ممتازة. مناسبة للمكاتب التي تحتاج طباعة كثيفة.', 'brand' => 'Xerox', 'specs' => ['السرعة: 31 صفحة/دقيقة', 'الدقة: 1200 dpi', 'الاتصال: WiFi + USB', 'سعة الورق: 250 ورقة']],
            // Mice
            ['id' => 7, 'name' => 'ماوس Logitech MX Master 3', 'category' => 'mice', 'price' => 599, 'old_price' => 749, 'badge' => 'خصم 20%', 'badge_color' => 'red', 'image' => 'mouse1', 'rating' => 5, 'reviews' => 256, 'description' => 'ماوس لاسلكي احترافي بتصميم مريح وعجلة تمرير ذكية. مثالي للمصممين والمبرمجين.', 'brand' => 'Logitech', 'specs' => ['الاتصال: Bluetooth + USB', 'البطارية: 70 يوم', 'الدقة: 200-4000 DPI', 'الأزرار: 7 أزرار']],
            ['id' => 8, 'name' => 'ماوس Razer DeathAdder V3', 'category' => 'mice', 'price' => 449, 'old_price' => null, 'badge' => 'جيمينج', 'badge_color' => 'green', 'image' => 'mouse2', 'rating' => 5, 'reviews' => 189, 'description' => 'ماوس ألعاب احترافي بتصميم خفيف الوزن وحساسية عالية. مثالي للاعبين المحترفين.', 'brand' => 'Razer', 'specs' => ['الاتصال: USB', 'الدقة: 100-30000 DPI', 'الوزن: 59g', 'الأزرار: 5 أزرار']],
            ['id' => 9, 'name' => 'ماوس Microsoft Arc Mouse', 'category' => 'mice', 'price' => 349, 'old_price' => 399, 'badge' => null, 'badge_color' => null, 'image' => 'mouse3', 'rating' => 4, 'reviews' => 78, 'description' => 'ماوس بلوتوث بتصميم مبتكر قابل للطي. مثالي للسفر والاستخدام المتنقل.', 'brand' => 'Microsoft', 'specs' => ['الاتصال: Bluetooth', 'البطارية: 6 أشهر', 'التصميم: قابل للطي', 'التوافق: Windows + Mac']],
            // Headphones
            ['id' => 10, 'name' => 'سماعة Sony WH-1000XM5', 'category' => 'headphones', 'price' => 1299, 'old_price' => 1599, 'badge' => 'مميز', 'badge_color' => 'purple', 'image' => 'headphone1', 'rating' => 5, 'reviews' => 312, 'description' => 'سماعة لاسلكية بخاصية إلغاء الضوضاء الرائدة في الصناعة. صوت استثنائي وراحة فائقة.', 'brand' => 'Sony', 'specs' => ['الاتصال: Bluetooth 5.2', 'البطارية: 30 ساعة', 'إلغاء الضوضاء: نعم', 'الوزن: 250g']],
            ['id' => 11, 'name' => 'سماعة JBL Tune 760NC', 'category' => 'headphones', 'price' => 699, 'old_price' => 899, 'badge' => 'خصم', 'badge_color' => 'red', 'image' => 'headphone2', 'rating' => 4, 'reviews' => 145, 'description' => 'سماعة لاسلكية بجودة صوت JBL الشهيرة وخاصية إلغاء الضوضاء بسعر مناسب.', 'brand' => 'JBL', 'specs' => ['الاتصال: Bluetooth 5.0', 'البطارية: 35 ساعة', 'إلغاء الضوضاء: نعم', 'الوزن: 222g']],
            ['id' => 12, 'name' => 'سماعة HyperX Cloud Alpha', 'category' => 'headphones', 'price' => 549, 'old_price' => null, 'badge' => 'جيمينج', 'badge_color' => 'green', 'image' => 'headphone3', 'rating' => 5, 'reviews' => 203, 'description' => 'سماعة ألعاب احترافية بصوت محيطي ومايكروفون قابل للفصل. مريحة للجلسات الطويلة.', 'brand' => 'HyperX', 'specs' => ['الاتصال: USB + 3.5mm', 'الصوت: 7.1 محيطي', 'المايكروفون: قابل للفصل', 'الوزن: 336g']],
            // Flash drives
            ['id' => 13, 'name' => 'فلاشة SanDisk Ultra 128GB', 'category' => 'flash', 'price' => 149, 'old_price' => null, 'badge' => null, 'badge_color' => null, 'image' => 'flash1', 'rating' => 4, 'reviews' => 89, 'description' => 'فلاشة USB 3.0 بسرعة نقل 130MB/s وسعة 128GB. مثالية لنقل الملفات الكبيرة بسرعة.', 'brand' => 'SanDisk', 'specs' => ['السعة: 128GB', 'السرعة: 130MB/s', 'الاتصال: USB 3.0', 'الضمان: 5 سنوات']],
            ['id' => 14, 'name' => 'فلاشة Kingston DataTraveler 256GB', 'category' => 'flash', 'price' => 249, 'old_price' => 299, 'badge' => 'خصم', 'badge_color' => 'red', 'image' => 'flash2', 'rating' => 4, 'reviews' => 56, 'description' => 'فلاشة USB 3.2 بسعة 256GB وسرعة نقل عالية. مثالية للمحترفين والمصورين.', 'brand' => 'Kingston', 'specs' => ['السعة: 256GB', 'السرعة: 200MB/s', 'الاتصال: USB 3.2', 'الضمان: مدى الحياة']],
            ['id' => 15, 'name' => 'فلاشة Samsung BAR Plus 64GB', 'category' => 'flash', 'price' => 99, 'old_price' => null, 'badge' => 'اقتصادي', 'badge_color' => 'blue', 'image' => 'flash3', 'rating' => 4, 'reviews' => 134, 'description' => 'فلاشة معدنية أنيقة بسرعة USB 3.1 وتصميم متين. مقاومة للماء والصدمات.', 'brand' => 'Samsung', 'specs' => ['السعة: 64GB', 'السرعة: 200MB/s', 'الاتصال: USB 3.1', 'المقاومة: ماء + صدمات']],
        ];
    }

    public function index(Request $request)
    {
        $products = $this->getAllProducts();
        $category = $request->get('category', 'all');
        $sort = $request->get('sort', 'default');

        if ($category !== 'all') {
            $products = array_filter($products, fn($p) => $p['category'] === $category);
            $products = array_values($products);
        }

        if ($sort === 'price_asc') {
            usort($products, fn($a, $b) => $a['price'] - $b['price']);
        } elseif ($sort === 'price_desc') {
            usort($products, fn($a, $b) => $b['price'] - $a['price']);
        } elseif ($sort === 'rating') {
            usort($products, fn($a, $b) => $b['rating'] - $a['rating']);
        }

        $categories = [
            'all' => 'جميع المنتجات',
            'printers' => 'الطابعات',
            'mice' => 'الماوسات',
            'headphones' => 'السماعات',
            'flash' => 'الفلاشات',
        ];

        return view('products.index', compact('products', 'category', 'sort', 'categories'));
    }

    public function category($category)
    {
        return redirect()->route('products.index', ['category' => $category]);
    }

    public function show($id)
    {
        $products = $this->getAllProducts();
        $product = collect($products)->firstWhere('id', (int)$id);

        if (!$product) {
            abort(404);
        }

        $related = collect($products)
            ->where('category', $product['category'])
            ->where('id', '!=', $product['id'])
            ->take(4)
            ->values()
            ->toArray();

        return view('products.show', compact('product', 'related'));
    }
}
