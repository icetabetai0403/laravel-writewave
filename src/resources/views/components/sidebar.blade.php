<div class="card">
    <div class="card-header">
        <h2 class="h5 mb-0">カテゴリー</h2>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            @foreach($categories as $category)
                <li><a href="{{ route('posts.index', ['category' => $category->id]) }}" class="text-decoration-none">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>