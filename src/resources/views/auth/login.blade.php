<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FashionablyLate</title>
    {{-- 土台のリセットCSS --}}
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    {{-- 今回作成する確認画面専用CSS --}}
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
    {{-- フォント設定 --}}
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">FashionablyLate</h1>
            <div class="header__link">
                <a href="/register" class="header__link-button">register</a>
            </div>
        </div>
    </header>

    <main class="auth-content">
        <h2 class="auth-content__title">Login</h2>
        <div class="auth-form">
            <form action="/login" method="post" novalidate>
                @csrf
                
                {{-- メールアドレス --}}
                <div class="form__group">
                    <label class="form__label">メールアドレス</label>
                    <div class="form__input">
                        {{-- value="{{ old('email') }}" を追加 --}}
                        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    </div>
                    {{-- エラー表示エリアを追加 --}}
                    <div class="form__error">
                        @error('email')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- パスワード --}}
                <div class="form__group">
                    <label class="form__label">パスワード</label>
                    <div class="form__input">
                        <input type="password" name="password" placeholder="例: coachtech1106">
                    </div>
                    <div class="form__error">
                        @error('password')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__button">
                    <button type="submit" class="form__button-submit">ログイン</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>