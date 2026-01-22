@extends('layouts.app')

@section('title', 'Confirm | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/contact_confirm.css') }}">
@endsection

@section('content')
<main class="main-content">
    <h2 class="page-title">Confirm</h2>
    <div class="form-container">
        <form action="/thanks" method="post" class="form">
            @csrf
            <table class="confirm-table">
                {{-- お名前 --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <span>{{ $inputs['last_name'] }}　{{ $inputs['first_name'] }}</span>
                        <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
                    </td>
                </tr>

                {{-- 性別 (数値から文字に変換して表示) --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <span>
                            @if($inputs['gender'] == 1) 男性
                            @elseif($inputs['gender'] == 2) 女性
                            @else その他 @endif
                        </span>
                        <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                    </td>
                </tr>

                {{-- メールアドレス --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <span>{{ $inputs['email'] }}</span>
                        <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                    </td>
                </tr>

                {{-- 電話番号 --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <span>{{ $inputs['tel'] }}</span>
                        <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
                        {{-- 修正ボタンで戻った時用 --}}
                        <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
                        <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
                        <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
                    </td>
                </tr>

                {{-- 住所 --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <span>{{ $inputs['address'] }}</span>
                        <input type="hidden" name="address" value="{{ $inputs['address'] }}">
                    </td>
                </tr>

                {{-- 建物名 --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <span>{{ $inputs['building'] }}</span>
                        <input type="hidden" name="building" value="{{ $inputs['building'] }}">
                    </td>
                </tr>

                {{-- お問い合わせの種類 --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <span>{{ $inputs['category_content'] ?? '選択されたカテゴリ' }}</span>
                        <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
                    </td>
                </tr>

                {{-- お問い合わせ内容 --}}
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <span>{{ $inputs['detail'] }}</span>
                        <input type="hidden" name="detail" value="{{ $inputs['detail'] }}">
                    </td>
                </tr>
            </table>

            <div class="form__button">
                <button type="submit" class="form__button-submit">送信</button>
                <button type="submit" name="back" class="form__button-fix">修正</button>
            </div>
        </form>
    </div>
</main>
@endsection