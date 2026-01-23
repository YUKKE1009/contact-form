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
                        {{-- 姓のグループ --}}
                        <div class="name-input-group">
                            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                            @error('last_name')
                            <p class="form__error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 名のグループ --}}
                        <div class="name-input-group">
                            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                            @error('first_name')
                            <p class="form__error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
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
                        {{-- 1つ目の箱 --}}
                        <div class="tel-input-group">
                            <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                            @error('tel1')
                            <p class="form__error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <span class="hyphen">-</span>

                        {{-- 2つ目の箱 --}}
                        <div class="tel-input-group">
                            <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                            @error('tel2')
                            <p class="form__error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <span class="hyphen">-</span>

                        {{-- 3つ目の箱 --}}
                        <div class="tel-input-group">
                            <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                            @error('tel3')
                            <p class="form__error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
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