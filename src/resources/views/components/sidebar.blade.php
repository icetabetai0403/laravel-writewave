@php
use App\Models\Post;
use App\Models\Category;

$months = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as post_count')
    ->groupBy('year', 'month')
    ->orderByDesc('year')
    ->orderByDesc('month')
    ->get();

$categories = Category::all();
@endphp

<div class="card mb-4 dark-mode-card">
    <div class="card-header dark-mode-card-header">
        <h2 class="h5 mb-0">カテゴリー</h2>
    </div>
    <div class="card-body dark-mode-card-body">
        <ul class="list-unstyled">
            @foreach($categories as $category)
                <li class="sidebar-list"><a href="{{ route('posts.index', ['category' => $category->id]) }}" class="text-decoration-none sidebar-text dark-mode-link">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card dark-mode-card">
    <div class="card-header dark-mode-card-header">
        <h2 class="h5 mb-0">投稿月</h2>
    </div>
    <div class="card-body dark-mode-card-body">
        <ul class="list-unstyled">
            @foreach($months as $month)
                <li class="sidebar-list">
                    <a href="{{ route('posts.index', ['year' => $month->year, 'month' => $month->month]) }}" class="text-decoration-none sidebar-text dark-mode-link">
                        {{ $month->year }}年{{ $month->month }}月 ({{ $month->post_count }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>