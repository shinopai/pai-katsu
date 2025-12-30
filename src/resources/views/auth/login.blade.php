@extends('layouts.app')

@section('content')
  <div class="auth">
    <h2 class="auth__heading">ログイン</h2>

    <form action="{{ route('login') }}" method="POST" class="auth__form" novalidate>
      @csrf

      <div class="auth__form-group">
        <label for="email" class="auth__form-label">
          メールアドレス
        </label>
        <input id="email" name="email" type="email" class="auth__form-input">
        @error('email')
          <p class="auth__error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="auth__form-group">
        <label for="password" class="auth__form-label">
          パスワード
        </label>
        <input id="password" name="password" type="password" class="auth__form-input">
      </div>

      <button type="submit" class="auth__form-button">
        ログイン
      </button>
    </form>

    <p class="auth__text">
      アカウントをお持ちでない方は
      <a href="{{ route('register') }}" class="auth__link">
        新規登録
      </a>
    </p>
  </div>
@endsection
