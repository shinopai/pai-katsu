@foreach ($posts as $post)
  @include('posts._item', ['post' => $post])
@endforeach

{{-- 次のページがある場合のみトリガーを出す --}}
@if ($posts->hasMorePages())
  <div id="xLoadTrigger" class="top__load-trigger" data-next-cursor="{{ $posts->nextCursor()?->encode() }}">
    読み込み中...
  </div>
@endif
