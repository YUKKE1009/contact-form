@extends('layouts.app')

@section('title', 'Login | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('header-nav')
{{-- ログイン画面の右上は register ボタンを表示 --}}
<a href="/register" class="header__action-btn">register</a>
@endsection

@section('content')
<main class="auth-content">
    <h2 class="auth-content__title">Login</h2>
    <div class="auth-form">
        <form action="/login" method="post" novalidate>
            @csrf

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
                <button type="submit" class="form__button-submit">ログイン</button>
            </div>
        </form>
    </div>
</main>
@endsection