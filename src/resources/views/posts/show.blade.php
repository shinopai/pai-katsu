@extends('layouts.app')

@section('content')
  <div class="post-show">
    <div class="wrap">
      {{-- 投稿詳細  --}}
      @include('posts._item', ['post' => $post])

      {{-- コメント一覧 --}}
      <section class="post-show__comments">
        @if ($post->comments()->count() > 0)
          <ul class="post-show__comment-list">
            @foreach ($post->comments as $comment)
              <li class="post-show__comment">
                <div class="post-show__comment-header flex">
                  <img
                    src="{{ $comment->user->icon ? asset('storage/' . $comment->user->icon) : asset('images/icon_user_01_dummy.webp') }}"
                    alt="{{ $comment->user->icon }}" class="post-show__comment-icon">

                  <div class="post-show__comment-meta flex">
                    <p class="post-show__comment-username">
                      {{ $comment->user->name }}
                    </p>
                    <time class="post-show__comment-time">
                      {{ $comment->created_at->format('Y/m/d H:i') }}
                    </time>
                  </div>
                </div>

                <div class="post-show__comment-body">
                  <p class="post-show__comment-content">
                    {{ $comment->content }}
                  </p>
                </div>
              </li>
            @endforeach
          </ul>
        @else
          <p class="post-show__no-comments">
            まだコメントがありません。
          </p>
        @endif
      </section>

      {{-- コメントフォーム --}}
      <section class="post-show__comment-form">
        <div class="post-show__comment-form-header flex">
          <img
            src="{{ Auth::user()->icon ? asset('storage/' . Auth::user()->icon) : asset('images/icon_user_01_dummy.webp') }}"
            alt="{{ Auth::user()->name }}" class="post-show__comment-form-icon">
          <span class="post-show__comment-form-username">
            {{ Auth::user()->name }}
          </span>
        </div>

        <form action="{{ route('comments.store', $post) }}" method="POST" id="xCommentForm" novalidate>
          @csrf
          @error('content')
            <p class="auth__error-message">{{ $message }}</p>
          @enderror

          <textarea name="content" class="post-show__comment-textarea" placeholder="" maxlength="250" required>{{ old('content') }}</textarea>
          <span class="post-show__comment-limit">
            250文字以内
          </span>

          <button type="submit" class="post-show__comment-submit">
            コメントする
          </button>
        </form>
      </section>
    </div>
  </div>
@endsection
