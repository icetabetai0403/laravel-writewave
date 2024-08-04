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

            @for ($i = 1; $i <= 3; $i++)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://i.pravatar.cc/40?img={{ $i }}" class="rounded-circle me-3" alt="ユーザーアバター">
                            <div>
                                <h5 class="mb-0">ユーザー名 {{ $i }}</h5>
                                <small class="text-muted">2024年7月{{ $i }}日</small>
                            </div>
                        </div>
                        <h3 class="card-title">ブログ記事タイトル {{ $i }}</h3>
                        <p class="card-text">これはブログ記事の短い説明です。ここに記事の要約や導入部分が入ります...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-primary">続きを読む</a>
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
            @endfor
        </div>
    </div>
</div>
@endsection