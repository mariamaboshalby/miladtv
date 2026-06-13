<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $categories = \App\Models\Category::active()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'brand'          => 'required|string|max:255',
            'category'       => 'required|string|exists:categories,slug',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'old_price'      => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'badge'          => 'nullable|string|max:50',
            'badge_color'    => 'nullable|string|max:50',
            'rating'         => 'required|integer|min:1|max:5',
            'specs'          => 'nullable|array',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpg,jpeg,png,webp|max:51200',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:51200',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        // إزالة images من البيانات قبل الحفظ
        unset($validated['images']);

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image && $image->isValid()) {
                    $product->addMedia($image)
                            ->toMediaCollection('product-images');
                }
            }
        }

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')
                    ->toMediaCollection('product-images');
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function edit(Product $product)
    {
        $categories = \App\Models\Category::active()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'brand'          => 'required|string|max:255',
            'category'       => 'required|string|exists:categories,slug',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'old_price'      => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'badge'          => 'nullable|string|max:50',
            'badge_color'    => 'nullable|string|max:50',
            'rating'         => 'required|integer|min:1|max:5',
            'specs'          => 'nullable|array',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpg,jpeg,png,webp|max:51200',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:51200',
            'delete_media'   => 'nullable|array',
            'delete_media.*' => 'integer',
            'main_media_id'  => 'nullable|integer',
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

        if ($request->filled('main_media_id')) {
            $mainId   = (int) $request->input('main_media_id');
            $mediaIds = $product->fresh()->getMedia('product-images')->pluck('id')->all();

            if (in_array($mainId, $mediaIds, true)) {
                $orderedIds = array_values(array_merge(
                    [$mainId],
                    array_values(array_filter($mediaIds, fn ($id) => $id !== $mainId))
                ));
                Media::setNewOrder($orderedIds);
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
