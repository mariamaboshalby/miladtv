<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug'      => 'required|string|max:255|unique:categories,slug',
            'name_ar'   => 'required|string|max:255',
            'name_en'   => 'required|string|max:255',
            'icon'      => 'nullable|string|max:255',
        ]);
        $validated['is_active'] = $request->boolean('is_active', true);

        Category::create($validated);

        $category = Category::where('slug', $validated['slug'])->first();

        if (request()->expectsJson()) {
            return response()->json($category, 201);
        }

        return redirect()->route('admin.categories.index')->with('success', 'تم إضافة الفئة بنجاح');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'slug'      => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'name_ar'   => 'required|string|max:255',
            'name_en'   => 'required|string|max:255',
            'icon'      => 'nullable|string|max:255',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'تم تعديل الفئة بنجاح');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'تم حذف الفئة بنجاح');
    }
}
