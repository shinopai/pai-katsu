@extends('layouts.app')

@section('content')
  <div class="top">
    <div class="wrap">
      <div class="top__content flex">
        {{-- サイドバー --}}
        @include('partials.sidebar')

        {{-- 投稿一覧 --}}
        <main class="top__posts" id="xTopPosts" data-load-url="/posts/load">
          @include('posts._list', ['posts' => $posts])
        </main>
      </div>
    </div>

    {{-- 新規投稿ボタン --}}
    @include('components.create_post_button')
  </div>
@endsection
