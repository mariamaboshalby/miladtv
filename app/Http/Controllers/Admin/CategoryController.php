<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        // Load full tree (roots → children → grandchildren)
        $tree = Category::with('allChildren')->roots()
                    ->orderBy('sort_order')->orderBy('name_ar')
                    ->get();

        // Flat list for stats row
        $totalCount = Category::count();

        return view('admin.categories.index', compact('tree', 'totalCount'));
    }

    public function create()
    {
        $parentOptions = Category::flatListForSelect();
        return view('admin.categories.create', compact('parentOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug'        => 'required|string|max:255|unique:categories,slug',
            'name_ar'     => 'required|string|max:255',
            'name_en'     => 'required|string|max:255',
            'parent_id'   => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'sort_order'  => 'nullable|integer|min:0',
            'icon'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $validated['is_active']  = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['parent_id']  = $validated['parent_id'] ?: null;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);
        \App\Services\CacheService::clearCategoryCaches();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'تم إضافة الفئة بنجاح');
    }

    public function edit(Category $category)
    {
        // Exclude current node (can't be its own parent) and its descendants
        $parentOptions = Category::flatListForSelect($category->id);
        return view('admin.categories.edit', compact('category', 'parentOptions'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'slug'        => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'name_ar'     => 'required|string|max:255',
            'name_en'     => 'required|string|max:255',
            'parent_id'   => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'sort_order'  => 'nullable|integer|min:0',
            'icon'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Prevent setting a descendant as parent (would create a cycle)
        if (! empty($validated['parent_id'])) {
            $descendants = $this->collectDescendantIds($category);
            if (in_array((int) $validated['parent_id'], $descendants) ||
                (int) $validated['parent_id'] === $category->id) {
                return back()->withErrors(['parent_id' => 'لا يمكن اختيار فئة فرعية كأصل لهذه الفئة.'])->withInput();
            }
            $validated['parent_id'] = (int) $validated['parent_id'];
        } else {
            $validated['parent_id'] = null;
        }

        // Handle image removal
        if ($request->boolean('remove_image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);
        \App\Services\CacheService::clearCategoryCaches();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'تم تعديل الفئة بنجاح');
    }

    public function destroy(Category $category)
    {
        // Re-parent children to this category's parent (or null = root)
        Category::where('parent_id', $category->id)
                ->update(['parent_id' => $category->parent_id]);

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();
        \App\Services\CacheService::clearCategoryCaches();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'تم حذف الفئة بنجاح');
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /** Collect all descendant IDs recursively to prevent circular parents */
    private function collectDescendantIds(Category $category): array
    {
        $ids = [];
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids   = array_merge($ids, $this->collectDescendantIds($child));
        }
        return $ids;
    }
}
