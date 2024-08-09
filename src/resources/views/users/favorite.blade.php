@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- いいね一覧 -->
        <div class="col-lg-9">
            <h1 class="mb-4">いいねした投稿</h1>

            @foreach ($favorite_posts as $favorite_post)
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">{{ $favorite_post->title }}</h3>
                        <p class="card-text">{{ Str::limit($favorite_post->content, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('posts.show', $favorite_post->id) }}" class="btn btn-outline-primary">続きを読む</a>
                            <form action="{{ route('favorites.destroy', $favorite_post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">いいね解除</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection