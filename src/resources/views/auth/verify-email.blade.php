@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- メール確認メッセージ -->
        <div class="col-lg-9">
            <h1 class="mb-4">会員登録ありがとうございます！</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">現在、仮会員の状態です。</p>
                    <p class="card-text">ただいま、ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。</p>
                    <p class="card-text">メール本文内のURLをクリックすると本会員登録が完了となります。</p>
                    <div class="text-center mt-4">
                        <a href="{{ url('/') }}" class="btn btn-primary">トップページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection