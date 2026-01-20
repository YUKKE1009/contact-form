<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | FashionablyLate</title>
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
                <a href="/login" class="header__link-button">login</a>
            </div>
        </div>
    </header>

    <main class="auth-content">
        <h2 class="auth-content__title">Register</h2>
        <div class="auth-form">
            <form action="/register" method="post" novalidate>
                @csrf
                {{-- お名前 --}}
                <div class="form__group">
                    <label class="form__label">お名前</label>
                    <div class="form__input">
                        <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                    </div>
                    {{-- エラー表示エリア --}}
                    <div class="form__error">
                        @error('name')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- メールアドレス --}}
                <div class="form__group">
                    <label class="form__label">メールアドレス</label>
                    <div class="form__input">
                        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    </div>
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
                    <button type="submit" class="form__button-submit">登録</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>