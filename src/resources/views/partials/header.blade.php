<header class="header">
  <div class="wrap">
    <div class="header__inner flex" data-controller="header">
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
          <a href="javascript:void(0)" class="header__nav-link header__nav-link--guest"
            data-action="click->header#operateMenu">{{ Auth::user()->name }}さん</a>
        @endguest
      </nav>
      @auth
        <ul class="header__dropdown">
          <li class="header__dropdown-item">
            <a href="{{ route('users.show', Auth::user()->id) }}">詳細</a>
          </li>
          <li class="header__dropdown-item">
            <form method="POST" action="{{ route('logout') }}" class="header__dropdown-form">
              @csrf
              <button type="submit" class="header__dropdown-button">
                ログアウト
              </button>
            </form>
          </li>
        </ul>
      @endauth
    </div>
  </div>
</header>
