@extends('layouts.app')

@section('title', 'Register | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('header-nav')
{{-- 登録画面の右上は login ボタンを表示 --}}
<a href="/login" class="header__action-btn">login</a>
@endsection

@section('content')
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
                <div class="form__error">
                    @error('name')
                    <p>{{ $message }}</p>
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
                    <p>{{ $message }}</p>
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
                    <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__button">
                <button type="submit" class="form__button-submit">登録</button>
            </div>
        </form>
    </div>
</main>
@endsection