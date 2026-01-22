@extends('layouts.app')

@section('title', 'Contact | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/contact_form.css') }}">
@endsection

@section('content')
<main class="main-content">
    <h2 class="page-title">Contact</h2>
    <div class="form-container">
        <form action="/confirm" method="post" class="form" novalidate>
            @csrf

            <div class="form__group">
                <div class="form__label">
                    <label>お名前<span class="form__required">※</span></label>
                </div>
                <div class="form__input">
                    <div class="form__input--name">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                    </div>
                    {{-- 個別エラー表示 --}}
                    @error('last_name')
                    <p class="form__error-message">{{ $message }}</p>
                    @enderror
                    @error('first_name')
                    <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>性別<span class="form__required">※</span></label>
                </div>
                <div class="form__input">
                    <div class="form__input--radio">
                        <label class="radio-label">
                            <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> <span>男性</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> <span>女性</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> <span>その他</span>
                        </label>
                    </div>
                    @error('gender')
                    <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>メールアドレス<span class="form__required">※</span></label>
                </div>
                <div class="form__input">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email')
                    <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>電話番号<span class="form__required">※</span></label>
                </div>
                <div class="form__input">
                    <div class="form__input--tel">
                        <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    </div>
                    {{-- 電話番号は3つのうち最初のエラーを表示 --}}
                    @if($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    <p class="form__error-message">
                        {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                    </p>
                    @endif
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>住所<span class="form__required">※</span></label>
                </div>
                <div class="form__input">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    @error('address')
                    <p class="form__error-message">{{ $message }}</p>
                    @enderror
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                    <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__group form__group--top">
                <div class="form__label">
                    <label>お問い合わせ内容<span class="form__required">※</span></label>
                </div>
                <div class="form__input">
                    <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail')
                    <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__button">
                <button type="submit">確認画面</button>
            </div>
        </form>
    </div>
</main>
@endsection