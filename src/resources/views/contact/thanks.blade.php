<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks | FashionablyLate</title>
    {{-- 土台のリセットCSS --}}
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    {{-- 今回作成する確認画面専用CSS --}}
    <link rel="stylesheet" href="{{ asset('css/contact/contact_thanks.css') }}">
    {{-- フォント設定 --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <main class="main">
        <div class="thanks__content">
            {{-- 背景の大きな透かし文字 --}}
            <div class="thanks__background">Thank you</div>

            {{-- 前面のメッセージとボタン --}}
            <div class="thanks__inner">
                <p class="thanks__text">お問い合わせありがとうございました</p>
                <div class="thanks__button">
                    <a href="/" class="thanks__button-link">HOME</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>