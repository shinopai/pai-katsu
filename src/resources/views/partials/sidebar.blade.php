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
      <span class="top__sidebar-ranking-month">{{ $currentMonth }}月</span>
    </div>

    <ul class="top__sidebar-ranking-list">
      @foreach ($monthlyRanking as $ranking)
        <li class="top__sidebar-ranking-item">
          <span
            class="top__sidebar-ranking-rank top__sidebar-ranking-rank--{{ $ranking->rank }}">{{ $ranking->rank }}</span>
          <a href="{{ route('users.show', $ranking->user->id) }}"
            class="top__sidebar-ranking-name">{{ $ranking->user->name }}さん</a>
          <span class="top__sidebar-ranking-count">
            <span class="top__sidebar-ranking-number">{{ $ranking->achievement_count }}</span>
            日
          </span>
        </li>
      @endforeach
    </ul>
  </div>
</aside>
