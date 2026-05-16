<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('title_ar', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->latest('published_at')->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'title_ar'     => 'nullable|string|max:255',
            'excerpt'      => 'required|string',
            'excerpt_ar'   => 'nullable|string',
            'content'      => 'required|string',
            'content_ar'   => 'nullable|string',
            'category'     => 'required|string|max:100',
            'author'       => 'required|string|max:100',
            'author_role'  => 'nullable|string|max:100',
            'read_time'    => 'required|integer|min:1',
            'tags'         => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'تم إضافة المقال بنجاح');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'title_ar'     => 'nullable|string|max:255',
            'excerpt'      => 'required|string',
            'excerpt_ar'   => 'nullable|string',
            'content'      => 'required|string',
            'content_ar'   => 'nullable|string',
            'category'     => 'required|string|max:100',
            'author'       => 'required|string|max:100',
            'author_role'  => 'nullable|string|max:100',
            'read_time'    => 'required|integer|min:1',
            'tags'         => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        $blog->update($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'تم تحديث المقال بنجاح');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'تم حذف المقال بنجاح');
    }
}
