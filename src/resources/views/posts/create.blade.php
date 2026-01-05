@extends('layouts.app')

@section('title', '新規投稿')

@section('content')
  <div class="post-create">
    <div class="wrap">
      <h2 class="post-create__heading">新規投稿</h2>

      {{-- バリデーションエラー --}}
      @if ($errors->any())
        <ul class="errors">
          @foreach ($errors->all() as $error)
            <li class="errors__item">{{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <form action="{{ route('posts.store') }}" method="POST" class="post-create__form" novalidate>
        @csrf

        {{-- 投稿内容 --}}
        <div class="post-create__group">
          <label for="detail" class="post-create__label">
            朝活内容
          </label>
          <textarea name="detail" id="detail" class="post-create__textarea" rows="6"
            placeholder="例：6時に起床してランニングと読書をしました" required>{{ old('detail') }}</textarea>
        </div>

        {{-- タグ入力（想定） --}}
        <div class="post-create__group">
          <label for="tags" class="post-create__label">
            タグ（カンマ区切り）
          </label>
          <input type="text" name="tags" id="tags" class="post-create__input" placeholder="例：ランニング, 読書"
            value="{{ old('tags') }}">
        </div>

        {{-- 送信ボタン --}}
        <div class="post-create__group">
          <button type="submit" class="post-create__submit">
            投稿する
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
