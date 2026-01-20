<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/contact/contact_form.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>


<body>

    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">FashionablyLate</h1>
        </div>
    </header>

    <main class="main">
        <div class="contact-form">
            <h2 class="page-title">Contact</h2>

            <form action="#" method="post" class="form">

                <div class="form__group">
                    <div class="form__label">
                        <label>お名前<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input form__input--name">
                        <input type="text" name="lastname" placeholder="例: 山田">
                        <input type="text" name="firstname" placeholder="例: 太郎">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>性別<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input form__input--radio">
                        <label class="radio-label">
                            <input type="radio" name="gender" value="male" checked> <span>男性</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="gender" value="female"> <span>女性</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="gender" value="other"> <span>その他</span>
                        </label>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>メールアドレス<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <input type="email" name="email" placeholder="例: test@example.com">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>電話番号<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input form__input--tel">
                        <input type="tel" name="tel1" placeholder="080">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel2" placeholder="1234">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel3" placeholder="5678">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>住所<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>建物名</label>
                    </div>
                    <div class="form__input">
                        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>お問い合わせの種類<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <div class="select-wrapper">
                            <select name="type">
                                <option value="" disabled selected>選択してください</option>
                                <option value="product">商品について</option>
                                <option value="delivery">発送について</option>
                                <option value="other">その他</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form__group form__group--top">
                    <div class="form__label">
                        <label>お問い合わせ内容<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <textarea name="content" rows="5" placeholder="お問い合わせ内容をご記載ください"></textarea>
                    </div>
                </div>

                <div class="form__button">
                    <button type="submit">確認画面</button>
                </div>

            </form>
        </div>
    </main>

</body>

</html>