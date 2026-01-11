@extends('layouts.app')

@section('content')
  <div class="user-show">
    <div class="wrap">
      <div class="user-show__card">
        <div class="user-show__header flex">
          <img class="user-show__icon"
            src="{{ $user->icon ? asset('storage/' . $user->icon) : asset('images/icon_user_01_dummy.webp') }}"
            alt="{{ $user->name }}">
          <div class="user-show__header-body">
            <div class="user-show__header-inner flex">
              <div class="user-show__profile">
                <p class="user-show__name">{{ $user->name }}</p>
                <p class="user-show__wakeup-time">
                  目標起床時間：{{ $user->wakeup_time->format('H:i') }}
                </p>
              </div>
              <div class="user-show__meta flex">
                <div class="user-show__calendar">
                  <span class="user-show__calendar-number">1</span>
                  <span class="user-show__calendar-month">月</span>
                </div>
                <div class="user-show__achievement">
                  <span class="user-show__achievement-label">早起き達成日数</span>
                  <span class="user-show__achievement-value">
                    <span class="user-show__achievement-number">0</span>
                    <span class="user-show__achievement-days">日目</span>
                  </span>
                </div>
                <button type="button" class="user-show__follow-button">
                  フォロー中
                </button>
              </div>
            </div>
            <small class="user-show__note">
              (04:00～{{ $user->wakeup_time }}に投稿できると早起き成功です)
            </small>
          </div>
        </div>
        <div class="user-show__stats flex">
          <span class="user-show__follow-count">0フォロー</span>
          <span class="user-show__follower-count">0フォロワー</span>
        </div>
      </div>

      {{-- 投稿一覧 --}}
      <div class="user-show__posts" data-controller="user">
        <div class="user-show__tabs flex">
          <div class="user-show__tab active" data-action="click->user#toggleTag">投稿</div>
          <div class="user-show__tab" data-action="click->user#toggleTag">いいね</div>
        </div>
        {{-- 自分の投稿 --}}
        <div class="user-show__data active" data-user-target="postData">
          @if ($user->posts()->exists())
            @foreach ($user->posts as $post)
              @include('posts._item', ['post' => $post])
            @endforeach
          @else
            <p class="user-show__no-posts-message">投稿がありません。</p>
          @endif
        </div>
        {{-- いいねした投稿 --}}
        <div class="user-show__data" data-user-target="likeData">
          @if ($user->posts()->exists())
            @foreach ($user->posts as $post)
              @include('posts._item', ['post' => $post])
            @endforeach
          @else
            <p class="user-show__no-posts-message">投稿がありません。</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
