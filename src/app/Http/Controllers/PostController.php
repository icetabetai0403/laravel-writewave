<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $categories = Category::all();
        $months = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as post_count')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        $query = Post::query();

        if ($request->category !== null) {
            $query->where('category_id', $request->category);
            $category = Category::find($request->category);
        } else {
            $category = null;
        }

        if ($keyword !== null) {
            $query->where('title', 'like', "%{$keyword}%");
        }

        if ($request->year && $request->month) {
            $query->whereYear('created_at', $request->year)
                    ->whereMonth('created_at', $request->month);
        }

        $sort = $request->input('sort', 'desc');
        $direction = $sort === 'asc' ? 'asc' : 'desc';

        $query->orderBy('created_at', $direction);

        $posts = $query->withCount(['favorite_users', 'comments'])->paginate(10);
        $total_count = $posts->total();

        return view('posts.index', compact('posts', 'category', 'categories', 'total_count', 'keyword', 'months', 'sort'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }

    public function destroy(Post $post) {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
    }
}
