<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | FashionablyLate</title>
    {{-- 土台のリセットCSS --}}
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    {{-- 今回作成する確認画面専用CSS --}}
    <link rel="stylesheet" href="{{ asset('css/contact/contact_form.css') }}">
    {{-- フォント設定 --}}
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

    <main class="main-content">
        <h2 class="page-title">Contact</h2>
        <div class="form-container">
            <form action="/confirm" method="post" class="form" novalidate>
                @csrf

                @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        {{-- 全てのエラーを取得し、重複を排除してループ --}}
                        @foreach (array_unique($errors->all()) as $error)
                        {{-- メッセージが空でない場合のみ表示 --}}
                        @if(!empty($error))
                        <li>{{ $error }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="form__group">
                    <div class="form__label">
                        <label>お名前<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input form__input--name">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>性別<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input form__input--radio">
                        <label class="radio-label">
                            <input type="radio" name="gender" value="1" checked> <span>男性</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="gender" value="2"> <span>女性</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="gender" value="3"> <span>その他</span>
                        </label>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>メールアドレス<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>電話番号<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input form__input--tel">
                        <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>住所<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>建物名</label>
                    </div>
                    <div class="form__input">
                        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>お問い合わせの種類<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <div class="select-wrapper">
                            <select name="category_id">
                                <option value="" disabled {{ old('category_id') == '' ? 'selected' : '' }}>選択してください</option>
                                @foreach($categories as $category)
                                {{-- 直前の入力値とループ中のIDが一致したら selected を出す --}}
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form__group form__group--top">
                    <div class="form__label">
                        <label>お問い合わせ内容<span class="form__required">※</span></label>
                    </div>
                    <div class="form__input">
                        <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
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