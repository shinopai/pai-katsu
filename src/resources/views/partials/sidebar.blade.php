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
      {{-- サイドバーのタグ一覧 --}}
      @foreach ($mainTags as $sideTag)
        <li class="top__sidebar-tags-item">
          <a href="{{ route('tags.show', ['tag' => $sideTag->id]) }}"
            class="top__sidebar-tags-link">#{{ $sideTag->name }}</a>
        </li>
      @endforeach
    </ul>
  </div>

  <!-- ランキング -->
  <div class="top__sidebar-ranking">
    <div class="top__sidebar-ranking-header">
      <span class="top__sidebar-ranking-title">早起き達成ランキング</span>
      <span class="top__sidebar-ranking-month">1月</span>
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
