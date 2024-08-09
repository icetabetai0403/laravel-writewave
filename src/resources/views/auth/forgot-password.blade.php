@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- パスワード再設定フォーム -->
        <div class="col-lg-9">
            <h1 class="mb-4">パスワード再設定</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">ご登録時のメールアドレスを入力してください。パスワード再発行用のメールをお送りします。</p>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">メールアドレスが正しくない可能性があります。</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection