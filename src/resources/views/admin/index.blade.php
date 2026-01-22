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
            <form action="/logout" method="post" class="header__action-form">
                @csrf
                <button type="submit" class="header__action-btn">logout</button>
            </form>
        </div>
    </header>

    <main class="admin-content">
        <h2 class="admin-title">Admin</h2>

        {{-- 検索フォーム (search.blade.php / search_reset.blade.php の役割) --}}
        <form class="search-form" action="/admin/search" method="get">
            <input type="text" name="keyword" class="search-form__input search-form__input--text" placeholder="名前やメールアドレスを入力してください">
            <select name="gender" class="search-form__select">
                <option value="">性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
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
            <a href="{{ route('admin.export', request()->query()) }}" class="btn-export">エクスポート</a>
            {{-- ページネーション --}}
            <div class="pagination">
                {{ $contacts->appends(request()->query())->links('pagination::bootstrap-4') }}
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
                <td class="admin-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td class="admin-table__item">
                    {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
                </td>
                <td class="admin-table__item">{{ $contact->email }}</td>
                <td class="admin-table__item">{{ $contact->category->content }}</td>
                <td class="admin-table__item">

                    {{-- 詳細ボタンはモーダルなどを開く処理 --}}
                    <button class="btn-detail"
                        data-id="{{ $contact->id }}"
                        data-last_name="{{ $contact->last_name }}"
                        data-first_name="{{ $contact->first_name }}"
                        data-gender="{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}"
                        data-email="{{ $contact->email }}"
                        data-tel="{{ $contact->tel }}"
                        data-address="{{ $contact->address }}"
                        data-building="{{ $contact->building }}"
                        data-category="{{ $contact->category->content }}"
                        data-detail="{{ $contact->detail }}">
                        詳細
                    </button>

                </td>
            </tr>
            @endforeach
        </table>
    </main>

    <div id="detail-modal" class="modal">
        <div class="modal__content">
            <div class="modal__header">
                <button id="close-modal" class="modal__close">×</button>
            </div>
            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td id="modal-name"></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td id="modal-gender"></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td id="modal-email"></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td id="modal-tel"></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td id="modal-address"></td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td id="modal-building"></td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td id="modal-category"></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td id="modal-detail"></td>
                </tr>
            </table>

            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">削除</button>
            </form>
        </div>
    </div>
    <script>
        const modal = document.getElementById('detail-modal');
        const closeBtn = document.getElementById('close-modal');
        const deleteForm = document.getElementById('delete-form');

        // 全ての詳細ボタンにクリックイベントを設定
        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', () => {
                // ボタンのdata属性から値を取得してモーダルにセット
                document.getElementById('modal-name').innerText = button.dataset.last_name + ' ' + button.dataset.first_name;
                document.getElementById('modal-gender').innerText = button.dataset.gender;
                document.getElementById('modal-email').innerText = button.dataset.email;
                document.getElementById('modal-tel').innerText = button.dataset.tel;
                document.getElementById('modal-address').innerText = button.dataset.address;
                document.getElementById('modal-building').innerText = button.dataset.building;
                document.getElementById('modal-category').innerText = button.dataset.category;
                document.getElementById('modal-detail').innerText = button.dataset.detail;

                // 削除フォームのアクションURLを動的に設定 (PG07)
                deleteForm.action = '/admin/delete/' + button.dataset.id;

                // モーダルを表示
                modal.style.display = 'flex';
            });
        });

        // 閉じるボタン
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // モーダル外側をクリックしても閉じるようにする
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.style.display = 'none';
        });
    </script>
</body>

</html>