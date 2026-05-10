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
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|in:printers,mice,headphones,flash',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'rating' => 'required|integer|min:1|max:5',
            'specs' => 'nullable|array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        Product::create($validated);

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
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|in:printers,mice,headphones,flash',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'rating' => 'required|integer|min:1|max:5',
            'specs' => 'nullable|array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }
}
