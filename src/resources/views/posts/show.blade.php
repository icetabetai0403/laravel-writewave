@extends('layouts.app')

@section('content')
  <h1>投稿詳細</h1>

  @if (session('flash_message'))
      <p>{{ session('flash_message') }}</p>
  @endif
  
  <a href="{{ route('posts.index') }}">&lt; 戻る</a>

  <article>
      <h2>{{ $post->title }}</h2>
      <p>{{ $post->content }}</p>

      <div class="row">
          @foreach($comments as $comment)
          <div class="offset-md-5 col-md-5">
              <p class="h3">{{$comment->content}}</p>
              <label>{{$comment->created_at}} {{$comment->user->name}}</label>
          </div>
          @endforeach
      </div><br />

      @auth
      <div class="row">
          <div class="offset-md-5 col-md-5">
              <form method="POST" action="{{ route('comments.store') }}">
                  @csrf
                  <h4>コメント内容</h4>
                  @error('content')
                      <strong>コメント内容を入力してください</strong>
                  @enderror
                  <textarea name="content" class="form-control m-2"></textarea>
                  <input type="hidden" name="post_id" value="{{$post->id}}">
                  <button type="submit" class="btn samuraimart-submit-button ml-2">コメントを追加</button>
              </form>
          </div>
      </div>
      @endauth

      @if ($post->user_id === Auth::id())
          <a href="{{ route('posts.edit', $post) }}">編集</a>

          <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
              @csrf
              @method('DELETE')
              <button type="submit">削除</button>
          </form>
      @endif
  </article>
@endsection