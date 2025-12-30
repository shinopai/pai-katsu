@extends('layouts.app')

@section('content')
  <div class="auth">
    <h2 class="auth__heading">新規登録</h2>

    <form action="{{ route('register') }}" method="POST" class="auth__form" novalidate>
      @csrf

      <div class="auth__form-group">
        <label for="name" class="auth__form-label">
          お名前
        </label>
        <input id="name" name="name" type="text" class="auth__form-input" value="{{ old('name') }}">
        @error('name')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="auth__form-group">
        <label for="email" class="auth__form-label">
          メールアドレス
        </label>
        <input id="email" name="email" type="email" class="auth__form-input" value="{{ old('email') }}">
        @error('email')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="auth__form-group">
        <label for="password" class="auth__form-label">
          パスワード
        </label>
        <input id="password" name="password" type="password" class="auth__form-input">
        @error('password')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="auth__form-group">
        <label for="password_confirmation" class="auth__form-label">
          パスワード（確認）
        </label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="auth__form-input">
      </div>

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
