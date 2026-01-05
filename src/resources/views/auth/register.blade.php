@extends('layouts.app')

@section('content')
  <div class="auth">
    <h2 class="auth__heading">新規登録</h2>

    <form action="{{ route('register') }}" method="POST" class="auth__form" enctype="multipart/form-data" novalidate>
      @csrf

      <!-- ユーザー名 -->
      <div class="auth__form-group">
        <label for="name" class="auth__form-label">
          お名前
        </label>
        <input id="name" name="name" type="text" class="auth__form-input" value="{{ old('name') }}">
        @error('name')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <!-- メールアドレス -->
      <div class="auth__form-group">
        <label for="email" class="auth__form-label">
          メールアドレス
        </label>
        <input id="email" name="email" type="email" class="auth__form-input" value="{{ old('email') }}">
        @error('email')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <!-- パスワード -->
      <div class="auth__form-group">
        <label for="password" class="auth__form-label">
          パスワード
        </label>
        <input id="password" name="password" type="password" class="auth__form-input">
        @error('password')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <!-- パスワード(確認) -->
      <div class="auth__form-group">
        <label for="password_confirmation" class="auth__form-label">
          パスワード（確認）
        </label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="auth__form-input">
      </div>

      <!-- ユーザーアイコン -->
      <div class="auth__form-group">
        <div class="auth__form-input-wrap--file">
          <input type="file" name="icon" id="icon" class="auth__form-input--file">
          <label for="icon" class="auth__form-label--file flex">
            <i class="fa-solid fa-paperclip auth__form-input-icon"></i>
            <span class="auth__form-text">ファイルを選択</span>
          </label>
        </div>
        @error('icon')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <!-- 起床時間 -->
      <div class="auth__form-group">
        <label for="wakeup_time" class="auth__form-label">
          起床時間&nbsp;<span class="auth__form-text--warning">&#8251;起床時刻は一度設定すると変更できません</span>
        </label>
        <input id="wakeup_time" name="wakeup_time" type="time" class="auth__form-input" min="04:00" max="10:00">
        @error('wakeup_time')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      {{-- <div class="post-create__group">
        <label for="wakeup_time" class="post-create__label">
          起床時間
        </label>
        <input type="time" name="wakeup_time" id="wakeup_time" class="post-create__input" min="04:00" max="10:00"
          value="{{ old('wakeup_time') }}" required>
      </div> --}}

      <button type="submit" class="auth__form-button">
        登録する
      </button>
    </form>

    <p class="auth__text">
      すでにアカウントをお持ちの方は
      <a href="{{ route('login') }}" class="auth__link">
        ログイン
      </a>
    </p>
  </div>
@endsection
