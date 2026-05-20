<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function toArray(Product $p): array
    {
        return [
            'id'          => $p->id,
            'name'        => $p->name,
            'brand'       => $p->brand,
            'category'    => $p->category,
            'price'       => $p->price,
            'old_price'   => $p->old_price,
            'badge'       => $p->badge,
            'badge_color' => $p->badge_color,
            'image_url'   => $p->getMainImageUrl('card'),
            'image'       => $p->image ?? 'product-1',
            'rating'      => $p->rating,
            'reviews'     => $p->reviews,
            'description' => $p->description,
            'specs'       => $p->specs ?? [],
        ];
    }

    public function index(Request $request)
    {
        $query    = Product::active();
        $category = $request->get('category', 'all');
        $sort     = $request->get('sort', 'default');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating'     => $query->orderBy('rating', 'desc'),
            default      => $query->latest(),
        };

        $products = $query->get()->map(fn($p) => $this->toArray($p))->toArray();

        $dbCategories = \App\Models\Category::active()->get();
        $categoryIconMap = $dbCategories->pluck('icon', 'slug')->toArray();

        return view('products.index', compact('products', 'category', 'sort', 'dbCategories', 'categoryIconMap'));
    }

    public function category($category)
    {
        return redirect()->route('products.index', ['category' => $category]);
    }

    public function show($id)
    {
        $product = Product::active()->findOrFail($id);

        $related = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get()
            ->map(fn($p) => $this->toArray($p))
            ->toArray();

        return view('products.show', [
            'product' => $this->toArray($product),
            'related' => $related,
        ]);
    }
}
