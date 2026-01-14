<a href="{{ route('posts.show', ['post' => $post->id]) }}">
  <article class="post-card">
    <!-- ヘッダー -->
    <header class="post-card__header flex">
      <div class="post-card__user flex">
        <div class="post-card__user-inner flex">
          <img
            src="{{ $post->user->icon ? asset('storage/' . $post->user->icon) : asset('images/icon_user_01_dummy.webp') }}"
            alt="$post->user->name" class="post-card__user-icon">
          <div class="post-card__user-info">
            <span class="post-card__user-name">{{ $post->user->name }}</span>
            <time class="post-card__date">{{ $post->created_at->format('Y/m/d H:i') }}</time>
            <!-- 目標時間 -->
            <div class="post-card__goal">
              <span class="post-card__goal-text">目標起床時間：{{ $post->user->wakeup_time->format('H:i') }}</span>
            </div>
          </div>
        </div>
      </div>

      @if (!empty($monthlyCounts[$post->user->id]))
        <div class="post-card__achievement">
          <span class="post-card__achievement-label">早起き</span>
          <span class="post-card__achievement-days">
            <span class="post-card__achievement-number">{{ $monthlyCounts[$post->user->id] }}</span>日目
          </span>
        </div>
      @endif
    </header>

    <!-- タグ -->
    <div class="post-card__tags">
      @foreach ($post->tags as $tag)
        <object>
          <a href="{{ route('tags.show', ['tag' => $tag->id]) }}" class="post-card__tag">#{{ $tag->name }}</a>
        </object>
      @endforeach
    </div>

    <!-- 本文 -->
    <div class="post-card__body">
      <p class="post-card__text">
        {{ $post->detail }}
      </p>
    </div>

    <!-- フッター -->
    <footer class="post-card__footer flex">
      <button class="post-card__comment">
        <span class="post-card__comment-count">{{ $post->comments()->count() }}</span>
      </button>
      {{-- いいねボタン --}}
      <like-button :count="{{ $post->likes()->count() }}" :liked="@json($post->isLikedBy(Auth::user()))"
        :post-id="{{ $post->id }}"></like-button>
    </footer>
  </article>
</a>
