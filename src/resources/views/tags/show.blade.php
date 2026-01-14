@extends('layouts.app')

@section('content')
  <div class="top">
    <div class="wrap">
      <div class="top__content flex">
        {{-- サイドバー --}}
        @include('partials.sidebar')

        {{-- 投稿一覧 --}}
        <main class="top__posts" id="xTopPosts" data-load-url="{{ route('tags.posts.load', $tag) }}">
          <div class="top__tag-header">
            <h1 class="top__tag-heading">
              #{{ $tag->name }}
            </h1>
            <p class="top__tag-post-count">
              {{ $tag->posts_count ?? '' }}件
            </p>
          </div>
          @include('posts._list', ['posts' => $posts, 'monthlyCounts' => $monthlyCounts])
        </main>
      </div>
    </div>

    {{-- 新規投稿ボタン --}}
    <x-floating-post-button href="{{ route('posts.create') }}" />
  </div>
@endsection
