<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- CSSの読み込み順序が重要です --}}
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            {{-- ロゴを中央にするための3カラム構造 --}}
            <div class="header__empty"></div>
            <div class="header__logo">
                <h1>FashionablyLate</h1>
            </div>
            <div class="header__nav">
                @yield('header-nav')
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>