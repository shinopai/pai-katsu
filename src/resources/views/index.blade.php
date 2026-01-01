@extends('layouts.app')

@section('content')
  <div class="top">
    <div class="wrap">
      <div class="top__content flex">
        <aside class="top__sidebar">
          <!-- ZOOM朝活 -->
          <div class="top__sidebar-zoom">
            <a href="#" class="top__sidebar-zoom-link">
              ZOOM朝活
            </a>
          </div>

          <!-- タグ一覧 -->
          <div class="top__sidebar-tags">
            <div class="top__sidebar-tags-header">
              <span class="top__sidebar-tags-title">メインタグ</span>
            </div>

            <ul class="top__sidebar-tags-list">
              <li class="top__sidebar-tags-item">
                <a href="#" class="top__sidebar-tags-link">#行動宣言</a>
              </li>
              <li class="top__sidebar-tags-item">
                <a href="#" class="top__sidebar-tags-link">#朝コツ</a>
              </li>
              <li class="top__sidebar-tags-item">
                <a href="#" class="top__sidebar-tags-link">#今朝の積み上げ</a>
              </li>
              <li class="top__sidebar-tags-item">
                <a href="#" class="top__sidebar-tags-link">#反省・気付き</a>
              </li>
              <li class="top__sidebar-tags-item">
                <a href="#" class="top__sidebar-tags-link">#質問</a>
              </li>
            </ul>
          </div>

          <!-- ランキング -->
          <div class="top__sidebar-ranking">
            <div class="top__sidebar-ranking-header">
              <span class="top__sidebar-ranking-title">早起き達成ランキング</span>
              <span class="top__sidebar-ranking-month">11月</span>
            </div>

            <ul class="top__sidebar-ranking-list">
              <li class="top__sidebar-ranking-item">
                <span class="top__sidebar-ranking-rank">1</span>
                <span class="top__sidebar-ranking-name">ゲストユーザーさん</span>
                <span class="top__sidebar-ranking-count">
                  <span class="top__sidebar-ranking-number">5</span>
                  日
                </span>
              </li>
              <li class="top__sidebar-ranking-item">
                <span class="top__sidebar-ranking-rank">2</span>
                <span class="top__sidebar-ranking-name">ゴリさん</span>
                <span class="top__sidebar-ranking-count">
                  <span class="top__sidebar-ranking-number">4</span>
                  日
                </span>

              </li>
              <li class="top__sidebar-ranking-item">
                <span class="top__sidebar-ranking-rank">2</span>
                <span class="top__sidebar-ranking-name">soraさん</span>
                <span class="top__sidebar-ranking-count">
                  <span class="top__sidebar-ranking-number">4</span>
                  日
                </span>
              </li>
              <li class="top__sidebar-ranking-item">
                <span class="top__sidebar-ranking-rank">3</span>
                <span class="top__sidebar-ranking-name">ケンさん</span>
                <span class="top__sidebar-ranking-count">
                  <span class="top__sidebar-ranking-number">3</span>
                  日
                </span>
              </li>
              <li class="top__sidebar-ranking-item">
                <span class="top__sidebar-ranking-rank">4</span>
                <span class="top__sidebar-ranking-name">daiさん</span>
                <span class="top__sidebar-ranking-count">
                  <span class="top__sidebar-ranking-number">2</span>
                  日
                </span>
              </li>
            </ul>
          </div>
        </aside>

        <main class="top__posts">
          <!-- 投稿カード -->
          <article class="top__post">
            <!-- ヘッダー -->
            <header class="top__post-header flex">
              <div class="top__post-user flex">
                <div class="top__post-user-inner flex">
                  <img src="{{ asset('images/icon_user_01_dummy.webp') }}" alt="" class="top__post-user-icon">
                  <div class="top__post-user-info">
                    <span class="top__post-user-name">sora</span>
                    <time class="top__post-date">2020/11/14 11:17</time>
                    <!-- 目標時間 -->
                    <div class="top__post-goal">
                      <span class="top__post-goal-text">目標起床時間：07:00</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="top__post-achievement">
                <span class="top__post-achievement-label">早起き</span>
                <span class="top__post-achievement-days">
                  <span class="top__post-achievement-number">4</span>日目
                </span>
              </div>
            </header>

            <!-- タグ -->
            <div class="top__post-tags">
              <a href="#" class="top__post-tag">#今朝の積み上げ</a>
            </div>

            <!-- 本文 -->
            <div class="top__post-body">
              <p class="top__post-text">
                土曜日でも朝活できると充実感がありますね ✨
              </p>
            </div>

            <!-- フッター -->
            <footer class="top__post-footer flex">
              <button class="top__post-comment">
                <span class="top__post-comment-count">1</span>
              </button>
              <button class="top__post-like">
                <span class="top__post-like-count">1</span>
              </button>
            </footer>
          </article>
          <article class="top__post">
            <!-- ヘッダー -->
            <header class="top__post-header flex">
              <div class="top__post-user flex">
                <div class="top__post-user-inner flex">
                  <img src="{{ asset('images/icon_user_01_dummy.webp') }}" alt="" class="top__post-user-icon">
                  <div class="top__post-user-info">
                    <span class="top__post-user-name">sora</span>
                    <time class="top__post-date">2020/11/14 11:17</time>
                    <!-- 目標時間 -->
                    <div class="top__post-goal">
                      <span class="top__post-goal-text">目標起床時間：07:00</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="top__post-achievement">
                <span class="top__post-achievement-label">早起き</span>
                <span class="top__post-achievement-days">
                  <span class="top__post-achievement-number">4</span>日目
                </span>
              </div>
            </header>

            <!-- タグ -->
            <div class="top__post-tags">
              <a href="#" class="top__post-tag">#今朝の積み上げ</a>
            </div>

            <!-- 本文 -->
            <div class="top__post-body">
              <p class="top__post-text">
                土曜日でも朝活できると充実感がありますね ✨
              </p>
            </div>

            <!-- フッター -->
            <footer class="top__post-footer flex">
              <button class="top__post-comment">
                <span class="top__post-comment-count">1</span>
              </button>
              <button class="top__post-like">
                <span class="top__post-like-count">1</span>
              </button>
            </footer>
          </article>
          <article class="top__post">
            <!-- ヘッダー -->
            <header class="top__post-header flex">
              <div class="top__post-user flex">
                <div class="top__post-user-inner flex">
                  <img src="{{ asset('images/icon_user_01_dummy.webp') }}" alt="" class="top__post-user-icon">
                  <div class="top__post-user-info">
                    <span class="top__post-user-name">sora</span>
                    <time class="top__post-date">2020/11/14 11:17</time>
                    <!-- 目標時間 -->
                    <div class="top__post-goal">
                      <span class="top__post-goal-text">目標起床時間：07:00</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="top__post-achievement">
                <span class="top__post-achievement-label">早起き</span>
                <span class="top__post-achievement-days">
                  <span class="top__post-achievement-number">4</span>日目
                </span>
              </div>
            </header>

            <!-- タグ -->
            <div class="top__post-tags">
              <a href="#" class="top__post-tag">#今朝の積み上げ</a>
            </div>

            <!-- 本文 -->
            <div class="top__post-body">
              <p class="top__post-text">
                土曜日でも朝活できると充実感がありますね ✨
              </p>
            </div>

            <!-- フッター -->
            <footer class="top__post-footer flex">
              <button class="top__post-comment">
                <span class="top__post-comment-count">1</span>
              </button>
              <button class="top__post-like">
                <span class="top__post-like-count">1</span>
              </button>
            </footer>
          </article>
        </main>

      </div>
    </div>
    <a href="{{ url('/') }}" class="top__new-post flex">
      <i class="fa-solid fa-plus top__new-post-icon" style="color: #ffffff;"></i>
      <span class="top__new-post-text">新規投稿</span>
    </a>
  </div>
@endsection
