<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $latestPosts = Post::with('user')
            ->withCount(['favorite_users', 'comments'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $trendingPosts = Post::with('user')
            ->withCount(['favorite_users', 'comments'])
            ->orderBy('favorite_users_count', 'desc')
            ->take(5)
            ->get();

        return view('web.index', compact('categories', 'latestPosts', 'trendingPosts'));
    }
}
