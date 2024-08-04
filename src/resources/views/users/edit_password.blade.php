@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- パスワード変更フォーム -->
        <div class="col-lg-9">
            <h1 class="mb-4">パスワード変更</h1>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('mypage.update_password') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="password" class="form-label">新しいパスワード</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">新しいパスワード（確認用）</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            パスワード更新
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection