<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <img src="{{ $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('images/default_profile.png') }}" class="rounded-circle me-3" alt="ユーザーアバター" style="width: 40px; height: 40px; object-fit: cover;">
            <div>
                <h5 class="mb-0">{{ $post->user->nickname }}</h5>
                <small class="text-muted">{{ $post->created_at->format('Y年m月d日') }}</small>
            </div>
        </div>
        <h3 class="card-title">{{ $post->title }}</h3>
        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary custom-btn me-2">続きを読む</a>
            </div>
            <div class="d-flex">
                <div class="me-2">
                    <i class="fas fa-thumbs-up"></i> {{ $post->favorite_users_count }}
                </div>
                <div class="me-2">
                    <i class="fas fa-comment"></i> {{ $post->comments_count }}
                </div>
            </div>
        </div>
    </div>
</div>