@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="form-container">
    <h2 class="form-title">Contact</h2>

    {{-- バリデーションエラー --}}
    @if ($errors->any())
    <div class="form-errors">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 入力フォーム --}}
    <form action="/confirm" method="POST" class="form">
        @csrf

        {{-- カテゴリー --}}
        <div class="form__item">
            <label for="category">カテゴリー</label>
            <select name="category_id" id="category">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- 名前 --}}
        <div class="form__item">
            <label for="first_name">姓</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
        </div>

        <div class="form__item">
            <label for="last_name">名</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
        </div>

        {{-- 性別 --}}
        <div class="form__item">
            <label>性別</label>
            <label><input type="radio" name="gender" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }}> 男性</label>
            <label><input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性</label>
        </div>

        {{-- メール --}}
        <div class="form__item">
            <label for="email">メール</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        {{-- 電話 --}}
        <div class="form__item">
            <label for="tel">電話番号</label>
            <input type="tel" name="tel" id="tel" value="{{ old('tel') }}">
        </div>

        {{-- 住所 --}}
        <div class="form__item">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}">
        </div>

        <div class="form__item">
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" value="{{ old('building') }}">
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form__item">
            <label for="detail">お問い合わせ内容</label>
            <textarea name="detail" id="detail">{{ old('detail') }}</textarea>
        </div>

        <button type="submit" class="form__btn">確認画面へ</button>
    </form>
</div>
@endsection