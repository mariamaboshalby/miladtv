<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        \Log::info('STORE - files: ' . json_encode(array_keys($request->allFiles())));
        \Log::info('STORE - has images: ' . ($request->hasFile('images') ? 'yes' : 'no'));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $k => $f) {
                \Log::info("Image[$k]: " . ($f ? $f->getClientOriginalName() . ' valid=' . ($f->isValid() ? 'yes' : 'no') : 'null'));
            }
        }
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'brand'          => 'required|string|max:255',
            'category'       => 'required|in:printers,mice,headphones,flash',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'old_price'      => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'badge'          => 'nullable|string|max:50',
            'badge_color'    => 'nullable|string|max:50',
            'rating'         => 'required|integer|min:1|max:5',
            'specs'          => 'nullable|array',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        // إزالة images من البيانات قبل الحفظ (لا تُخزَّن في جدول products)
        unset($validated['images']);

        $product = Product::create($validated);

        // رفع الصور عبر Spatie Media Library
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image && $image->isValid()) {
                    $product->addMedia($image)
                            ->toMediaCollection('product-images');
                }
            }
        }

        // رفع صورة واحدة (fallback)
        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')
                    ->toMediaCollection('product-images');
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'brand'          => 'required|string|max:255',
            'category'       => 'required|in:printers,mice,headphones,flash',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'old_price'      => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'badge'          => 'nullable|string|max:50',
            'badge_color'    => 'nullable|string|max:50',
            'rating'         => 'required|integer|min:1|max:5',
            'specs'          => 'nullable|array',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpg,jpeg,png,webp|max:10240',
            'delete_media'   => 'nullable|array',
            'delete_media.*' => 'integer',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        // إزالة images و delete_media من البيانات قبل الحفظ
        unset($validated['images'], $validated['delete_media']);

        $product->update($validated);

        if ($request->filled('delete_media')) {
            foreach ($request->input('delete_media') as $mediaId) {
                $product->deleteMedia($mediaId);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)
                        ->toMediaCollection('product-images');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy(Product $product)
    {
        $product->clearMediaCollection('product-images');
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }
}
