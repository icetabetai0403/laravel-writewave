@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- マイページコンテンツ -->
        <div class="col-lg-9">
            <h1 class="mb-4 dark-mode-text">マイページ</h1>

            <div class="card mb-4 dark-mode-card">
                <div class="card-body dark-mode-card-body">
                    <div class="d-flex align-items-center mb-3">
                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/100' }}" class="rounded-circle me-3" alt="プロフィール画像" style="width: 100px; height: 100px; object-fit: cover;">
                        <div>
                            <h2 class="h4 mb-0 dark-mode-text">{{ $user->name }}</h2>
                            <p class="text-muted mb-0 dark-mode-text">ニックネーム：{{ $user->nickname }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 dark-mode-card">
                <div class="card-body dark-mode-card-body">
                    <h3 class="card-title dark-mode-text">アカウント管理</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center pt-3 pb-3 dark-mode-list-item">
                            <div>
                                <h4 class="h6 mb-0 dark-mode-text">会員情報の編集</h4>
                                <small class="text-muted dark-mode-text">アカウント情報の編集</small>
                            </div>
                            <a href="{{ route('mypage.edit') }}" class="btn btn-outline-primary custom-btn dark-mode-btn">編集</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center pt-3 pb-3 dark-mode-list-item">
                            <div>
                                <h4 class="h6 mb-0 dark-mode-text">パスワード変更</h4>
                                <small class="text-muted dark-mode-text">パスワードを変更します</small>
                            </div>
                            <a href="{{ route('mypage.edit_password') }}" class="btn btn-outline-primary custom-btn dark-mode-btn">編集</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center pt-3 pb-3 dark-mode-list-item">
                            <div>
                                <h4 class="h6 mb-0 dark-mode-text">いいね一覧</h4>
                                <small class="text-muted dark-mode-text">いいねした投稿を確認します</small>
                            </div>
                            <a href="{{ route('mypage.favorite') }}" class="btn btn-outline-primary custom-btn dark-mode-btn">表示</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection