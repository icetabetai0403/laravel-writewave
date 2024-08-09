@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- サイドバー -->
        <div class="col-lg-3 mb-4">
            <x-sidebar :categories="$categories" />
        </div>

        <!-- 編集フォーム -->
        <div class="col-lg-9">
            <h1 class="mb-4">投稿編集</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">本文</label>
                    <textarea class="form-control" id="content" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">カテゴリー</label>
                    <select class="form-select" id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
            </form>
        </div>
    </div>
</div>
@endsection