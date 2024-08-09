@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- ログインフォーム -->
        <div class="col-lg-9">
            <h1 class="mb-4">ログイン</h1>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">メールアドレスが正しくない可能性があります。</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">パスワード</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">パスワードが正しくない可能性があります。</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">次回から自動的にログインする</label>
                        </div>

                        <button type="submit" class="btn btn-primary">ログイン</button>
                    </form>

                    <div class="mt-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">パスワードをお忘れの場合</a>
                    </div>

                    <hr>

                    <div class="text-center">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">新規登録</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection