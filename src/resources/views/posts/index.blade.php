@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            @component('components.sidebar', ['categories' => $categories])
            @endcomponent
        </div>

        <!-- ブログ記事一覧 -->
        <div class="col-lg-9">
            <h1 class="mb-4">投稿一覧</h1>

            <div class="container">
              @if ($category !== null)
                  <a href="{{ route('posts.index') }}">トップ</a> > <a href="#">{{ $category->name }}</a>
                  <h1>{{ $category->name }}の記事一覧{{$total_count}}件</h1>
                  @elseif ($keyword !== null)
                  <a href="{{ route('posts.index') }}">トップ</a> > 記事一覧
                  <h1>"{{ $keyword }}"の検索結果{{$total_count}}件</h1>
              @endif
            </div>
            <div>
              Sort By
              @sortablelink('created_at', '投稿日')
            </div>

            @if (session('flash_message'))
                <div class="alert alert-success">{{ session('flash_message') }}</div>
            @endif

            @if (session('error_message'))
                <div class="alert alert-danger">{{ session('error_message') }}</div>
            @endif

            <div class="mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
            </div>

            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#">最新</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">トレンド</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">フォロー中</a>
                </li>
            </ul>

            @if($posts->isNotEmpty())
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://i.pravatar.cc/40?img={{ $loop->iteration }}" class="rounded-circle me-3" alt="ユーザーアバター">
                                <div>
                                    <h5 class="mb-0">{{ $post->user->name }}</h5>
                                    <small class="text-muted">{{ $post->created_at->format('Y年m月d日') }}</small>
                                </div>
                            </div>
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary me-2">詳細</a>
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-secondary me-2">編集</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">削除</button>
                                    </form>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-thumbs-up"></i> {{ rand(1, 100) }}
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-comment"></i> {{ rand(1, 20) }}
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>投稿はありません。</p>
            @endif

            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection