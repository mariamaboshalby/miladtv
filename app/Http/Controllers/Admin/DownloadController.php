<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $query = Download::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $downloads = $query->latest()->paginate(15);

        return view('admin.downloads.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:100',
            'brand'       => 'nullable|string|max:100',
            'version'     => 'nullable|string|max:50',
            'size'        => 'nullable|string|max:50',
            'os'          => 'nullable|string|max:100',
            'icon'        => 'nullable|string|max:50',
            'file_url'    => 'nullable|url|max:500',
            'image'       => 'nullable|image|mimes:jpeg,png,webp,gif|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('downloads', 'public');
        }

        Download::create($validated);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'تم إضافة الملف بنجاح');
    }

    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:100',
            'brand'       => 'nullable|string|max:100',
            'version'     => 'nullable|string|max:50',
            'size'        => 'nullable|string|max:50',
            'os'          => 'nullable|string|max:100',
            'icon'        => 'nullable|string|max:50',
            'file_url'    => 'nullable|url|max:500',
            'image'       => 'nullable|image|mimes:jpeg,png,webp,gif|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إن وجدت
            if ($download->image) {
                Storage::disk('public')->delete($download->image);
            }
            $validated['image'] = $request->file('image')->store('downloads', 'public');
        }

        // حذف الصورة إذا طلب المستخدم ذلك
        if ($request->boolean('remove_image') && $download->image) {
            Storage::disk('public')->delete($download->image);
            $validated['image'] = null;
        }

        $download->update($validated);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'تم تحديث الملف بنجاح');
    }

    public function destroy(Download $download)
    {
        if ($download->image) {
            Storage::disk('public')->delete($download->image);
        }

        $download->delete();

        return redirect()->route('admin.downloads.index')
            ->with('success', 'تم حذف الملف بنجاح');
    }
}
