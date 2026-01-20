@extends('layouts.app')

@section('title', 'Login')

@section('header-nav')
<ul class="header-nav">
    <li class="header-nav__item">
        <a class="header-nav__link" href="/register">register</a>
    </li>
</ul>
@endsection

@section('content')
<div class="auth-container">
    <h2 class="page-title">Login</h2>
    <form action="/login" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">メールアドレス</label>
            <input type="email" class="form-input" name="email" placeholder="例: test@example.com">
        </div>
        <div class="form-group">
            <label class="form-label">パスワード</label>
            <input type="password" class="form-input" name="password" placeholder="例: coachtech1106">
        </div>
        <div class="form-button-area">
            <button type="submit" class="btn-submit">ログイン</button>
        </div>
    </form>
</div>
@endsection