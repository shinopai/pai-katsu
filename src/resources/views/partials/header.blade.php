<header class="header">
  <div class="wrap">
    <div class="header__inner flex">
      <a href="{{ url('/') }}" class="contents">
        <h1 class="header__title">
          PaiKatsu
        </h1>
      </a>
      <nav class="header__nav flex">
        @guest
          <a href="{{ route('login') }}" class="header__nav-link header__nav-link--login">ログイン</a>
          <a href="{{ route('register') }}" class="header__nav-link header__nav-link--register">新規登録</a>
        @else
          <a href="{{ url('/') }}" class="header__nav-link header__nav-link--zoom">Zoom朝活</a>
          <a href="{{ route('posts.create') }}" class="header__nav-link header__nav-link--post">投稿する</a>
          <a href="{{ url('/') }}" class="header__nav-link header__nav-link--guest">{{ Auth::user()->name }}さん</a>
        @endguest
      </nav>
    </div>
  </div>
</header>
