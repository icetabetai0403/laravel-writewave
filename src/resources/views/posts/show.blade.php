@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- 記事詳細 -->
        <div class="col-lg-9">

            <h1 class="mb-2">{{ $post->title }}</h1>
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('images/default_profile.png') }}" class="rounded-circle me-3" alt="ユーザーアバター" style="width: 40px; height: 40px; object-fit: cover;">
                <div>
                    <h5 class="mb-0">{{ $post->user->nickname }}</h5>
                    <small class="text-muted">{{ $post->created_at->format('Y年m月d日') }}</small>
                </div>
            </div>

            @if (session('flash_message'))
                <div class="alert alert-success">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="text-muted">カテゴリー：{{ $post->category->name }}</p>
                    
                    @auth
                    <div class="d-flex justify-content-between align-items-center">
                        @if(Auth::user()->favorite_posts()->where('post_id', $post->id)->exists())
                            <form action="{{ route('favorites.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger custom-btn">
                                    <i class="fas fa-thumbs-up"></i> いいね解除
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favorites.store', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary custom-btn">
                                    <i class="fas fa-thumbs-up"></i> いいね
                                </button>
                            </form>
                        @endif

                        @if ($post->user_id === Auth::id())
                            <div>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-secondary custom-btn">編集</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger custom-btn">削除</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    @endauth
                </div>
            </div>

            <!-- コメント一覧 -->
            <h2 class="mb-3">コメント</h2>
            @foreach($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{$comment->content}}</p>
                    <p class="card-text"><small class="text-muted">{{$comment->created_at->format('Y年m月d日')}} by {{$comment->user->nickname}}</small></p>
                </div>
            </div>
            @endforeach

            <!-- コメント投稿フォーム -->
            @auth
            <form method="POST" action="{{ route('comments.store') }}" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">コメント</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div>
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <button type="submit" class="btn btn-primary custom-btn">コメントを追加</button>
            </form>
            @endauth

            <a href="{{ route('posts.index') }}" class="btn btn-secondary custom-btn">&lt; 戻る</a>
        </div>
    </div>
</div>
@endsection