<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>

    {{-- ヘッダー --}}
    <header class="header">
        <h1 class="header__logo">FashionablyLate</h1>

        {{-- ナビゲーション差し込み用 --}}
        <nav class="header__nav">
            @yield('header-nav')
        </nav>
    </header>

    {{-- メインコンテンツ --}}
    <main class="main">
        @yield('content')
    </main>

</body>

</html>