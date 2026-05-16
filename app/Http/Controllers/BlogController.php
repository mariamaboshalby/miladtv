<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::active()->latest('published_at')->get();

        return view('blog.index', compact('posts'));
    }

    public function show($id)
    {
        $post = BlogPost::active()->findOrFail($id);

        // increment views
        $post->increment('views');

        $related = BlogPost::active()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
