<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    {{-- 土台のリセットCSS --}}
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    {{-- 今回作成する確認画面専用CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <title>Admin | FashionablyLate</title>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">FashionablyLate</h1>
            <a href="#" class="header__logout-btn">logout</a>
        </div>
    </header>

    <main class="admin-content">
        <h2 class="admin-title">Admin</h2>

        {{-- 検索フォーム (search.blade.php / search_reset.blade.php の役割) --}}
        <form class="search-form" action="/admin/search" method="get">
            <input type="text" name="keyword" class="search-form__input search-form__input--text" placeholder="名前やメールアドレスを入力してください">
            <select name="gender" class="search-form__select">
                <option value="">性別</option>
            </select>

            <select name="category_id" class="search-form__select">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>

            <input type="date" name="date" class="search-form__select">
            <button type="submit" class="search-form__btn-search">検索</button>
            <a href="/admin" class="search-form__btn-reset">リセット</a>
        </form>

        <div class="admin-toolbar">
            <button class="btn-export">エクスポート</button>
            {{-- ページネーション --}}
            <div class="pagination">
                <a href="#" class="pagination__link">&lt;</a>
                <a href="#" class="pagination__link pagination__link--active">1</a>
                <a href="#" class="pagination__link">2</a>
                <a href="#" class="pagination__link">3</a>
                <a href="#" class="pagination__link">&gt;</a>
            </div>
        </div>

        <table class="admin-table">
            <tr class="admin-table__row--header">
                <th class="admin-table__header">お名前</th>
                <th class="admin-table__header">性別</th>
                <th class="admin-table__header">メールアドレス</th>
                <th class="admin-table__header">お問い合わせの種類</th>
                <th class="admin-table__header"></th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="admin-table__row">
                <td class="admin-table__item">{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                <td class="admin-table__item">
                    {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
                </td>
                <td class="admin-table__item">{{ $contact->email }}</td>
                <td class="admin-table__item">{{ $contact->category->content }}</td>
                <td class="admin-table__item">
                    {{-- 詳細ボタンはモーダルなどを開く処理 --}}
                    <button class="btn-detail">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </main>
</body>

</html>