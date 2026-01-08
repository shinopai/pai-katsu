<article class="top__post">
  <!-- ヘッダー -->
  <header class="top__post-header flex">
    <div class="top__post-user flex">
      <div class="top__post-user-inner flex">
        <img
          src="{{ $post->user->icon ? asset('storage/' . $post->user->icon) : asset('images/icon_user_01_dummy.webp') }}"
          alt="$post->user->name" class="top__post-user-icon">
        <div class="top__post-user-info">
          <span class="top__post-user-name">{{ $post->user->name }}</span>
          <time class="top__post-date">{{ $post->created_at->format('Y/m/d H:i') }}</time>
          <!-- 目標時間 -->
          <div class="top__post-goal">
            <span class="top__post-goal-text">目標起床時間：{{ $post->user->wakeup_time }}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="top__post-achievement">
      <span class="top__post-achievement-label">早起き</span>
      <span class="top__post-achievement-days">
        <span class="top__post-achievement-number">4</span>日目
      </span>
    </div>
  </header>

  <!-- タグ -->
  <div class="top__post-tags">
    @foreach ($post->tags as $tag)
      <a href="{{ route('tags.show', ['tag' => $tag->id]) }}" class="top__post-tag">#{{ $tag->name }}</a>
    @endforeach
  </div>

  <!-- 本文 -->
  <div class="top__post-body">
    <p class="top__post-text">
      {{ $post->detail }}
    </p>
  </div>

  <!-- フッター -->
  <footer class="top__post-footer flex">
    <button class="top__post-comment">
      <span class="top__post-comment-count">0</span>
    </button>
    <button class="top__post-like">
      <span class="top__post-like-count">0</span>
    </button>
  </footer>
</article>
