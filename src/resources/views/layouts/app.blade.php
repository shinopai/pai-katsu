<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'PaiKatsu')</title>

  {{-- include css --}}
  @vite(['resources/js/app.js'])

  {{-- google fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap"
    rel="stylesheet">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
</head>

<body>
  {{-- ヘッダー --}}
  @include('partials.header')

  {{-- メインコンテンツ --}}
  <main class="main">
    <div class="wrap">
      @yield('content')
    </div>
  </main>
</body>

</html>
