@extends('layouts.app')

@section('content')
  <h1>新規投稿</h1>

  @if ($errors->any())
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  @endif

  <a href="{{ route('posts.index') }}">&lt; 戻る</a>

  <form action="{{ route('posts.store') }}" method="POST">
      @csrf
      <div>
          <label for="title">タイトル</label>
          <input type="text" id="title" name="title" value="{{ old('title') }}">
      </div>
      <div>
          <label for="content">本文</label>
          <textarea id="content" name="content">{{ old('content') }}</textarea>
      </div>
      <button type="submit">投稿</button>
  </form>
@endsection