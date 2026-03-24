<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderByDesc('created_at')->paginate(12);

        return view('blogs.index', compact('blogs'));
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('blogs.show', compact('blog', 'recentBlogs'));
    }
}
