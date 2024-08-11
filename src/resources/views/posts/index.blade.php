@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            @component('components.sidebar', ['categories' => $categories, 'months' => $months])
            @endcomponent
        </div>

        <!-- ブログ記事一覧 -->
        <div class="col-lg-9">
            <h1 class="mb-4">投稿一覧</h1>

            <div class="container mb-3">
              @if ($category !== null)
                  <h2 class="h4">{{ $category->name }}の記事一覧 ({{$total_count}}件)</h2>
              @elseif ($keyword !== null)
                  <h2 class="h4">"{{ $keyword }}"の検索結果 ({{$total_count}}件)</h2>
              @elseif (isset($year) && isset($month))
                  <h2 class="h4">{{ $year }}年{{ $month }}月の投稿一覧 ({{$total_count}}件)</h2>
              @endif
            </div>

            <div class="d-flex mb-3 align-items-center">
              <div>
                <label for="sort-select">並び替え:</label>
              </div>
              <div>
                <select id="sort-select" class="form-select custom-select ms-2" style="width: auto;">
                      <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>新しい順</option>
                      <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>古い順</option>
                </select>
              </div>
            </div>

            @if (session('flash_message'))
                <div class="alert alert-success">{{ session('flash_message') }}</div>
            @endif

            @if (session('error_message'))
                <div class="alert alert-danger">{{ session('error_message') }}</div>
            @endif

            <div class="mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-primary custom-btn">新規投稿</a>
            </div>

            @if($posts->isNotEmpty())
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                            <img src="{{ $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('images/default_profile.png') }}" class="rounded-circle me-3" alt="ユーザーアバター" style="width: 40px; height: 40px; object-fit: cover;">
                                <div>
                                    <h5 class="mb-0">{{ $post->user->nickname }}</h5>
                                    <small class="text-muted">{{ $post->created_at->format('Y年m月d日') }}</small>
                                </div>
                            </div>
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary custom-btn me-2">続きを読む</a>
                                    @if(Auth::id() === $post->user_id)
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-secondary custom-btn me-2">編集</a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger custom-btn">削除</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="d-flex">
                                  <div class="me-2">
                                      <i class="fas fa-thumbs-up"></i> {{ $post->favorite_users_count }}
                                  </div>
                                  <div class="me-2">
                                      <i class="fas fa-comment"></i> {{ $post->comments_count }}
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>投稿はありません。</p>
            @endif

            <div class="d-flex justify-content-center">
                {{ $posts->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('sort-select').addEventListener('change', function() {
    var sortValue = this.value;
    var currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('sort', sortValue);
    
    // 現在のページパラメータを削除
    currentUrl.searchParams.delete('page');
    
    window.location.href = currentUrl.toString();
});
</script>
@endsection