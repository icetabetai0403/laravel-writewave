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
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="latest-tab" data-bs-toggle="tab" data-bs-target="#latest" type="button" role="tab" aria-controls="latest" aria-selected="true">最新</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="trending-tab" data-bs-toggle="tab" data-bs-target="#trending" type="button" role="tab" aria-controls="trending" aria-selected="false">トレンド</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                    @foreach($latestPosts as $post)
                        @include('partials.post_card', ['post' => $post])
                    @endforeach
                </div>
                <div class="tab-pane fade" id="trending" role="tabpanel" aria-labelledby="trending-tab">
                    @foreach($trendingPosts as $post)
                        @include('partials.post_card', ['post' => $post])
                    @endforeach
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('posts.index') }}" class="btn btn-primary custom-btn">すべての投稿を見る</a>
            </div>
        </div>
    </div>
</div>
@endsection