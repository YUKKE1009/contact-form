<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    // 入力画面
    public function index(Request $request)
    {
        // 1. クエリビルダーを開始
        $query = Contact::query();

        // 2. 名前検索（姓 or 名 で部分一致）
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        // 3. 性別検索（1:男性 2:女性 3:その他）※「全て」以外が選ばれた時
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // 4. カテゴリ検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 5. 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 6. 7件ずつページネーション（検索条件を保持したまま）
        $contacts = $query->paginate(7)->withQueryString();

        // カテゴリ一覧（検索窓のプルダウン用）も取得
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    // 確認画面
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        // 電話番号を結合して一つの 'tel' として扱う
        $inputs['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        return view('contact.contact_confirm', compact('inputs'));
    }
    // 保存処理
    public function store(Request $request) // 保存時はRequest(バリデーション済みのデータが来るため)
    {
        // 「修正」ボタンが押された場合の処理（もしconfirm画面に[修正]ボタンがあるなら）
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        // データの保存
        Contact::create($request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel', // confirm画面で結合済みのtelを渡す想定
            'address',
            'building',
            'detail',
        ]));

        // 二重送信防止のためリダイレクト。URLは /thanks (PG03) へ
        // thanks画面自体は static な画面なので redirect先で表示させるのが一般的
        return redirect('/thanks');
    }
    
    public function thanks()
    {
        return view('contact.contact_thanks');
    }

    // 管理画面の一覧・検索 (FN022)
    public function admin(Request $request)
    {
        $query = Contact::query();

        // 1. 名前やメールアドレスの部分一致 (FN022-1, 2)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%") // 姓の部分一致
                    ->orWhere('first_name', 'like', "%{$keyword}%") // 名の部分一致
                    ->orWhere('email', 'like', "%{$keyword}%") // メール
                    // ここがフルネーム検索のポイント
                    ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ["%{$keyword}%"])
                    // スペースが入っている場合も考慮
                    ->orWhereRaw('CONCAT(last_name, " ", first_name) LIKE ?', ["%{$keyword}%"]);
            });
        }

        // 2. 性別検索 (FN022-3)
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 3. お問い合わせの種類 (FN022-4)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. 日付 (FN022-5)
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 7件ごとのページネーション + 検索条件の保持 (FN021)
        $contacts = $query->with('category')->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    // PG07: 削除機能
    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect('/admin');
    }

    // PG11: エクスポート機能
    public function export(Request $request)
    {
        // 1. 検索条件を適用（adminメソッドと同じロジック）
        $query = Contact::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
        // ...（他の性別やカテゴリの検索条件も同様に追記）...

        $contacts = $query->with('category')->get();

        // 2. CSVのヘッダー作成
        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '内容'];
        $csvData = [];

        foreach ($contacts as $contact) {
            $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $csvData[] = [
                $contact->last_name . $contact->first_name,
                $gender,
                $contact->email,
                $contact->category->content,
                $contact->detail
            ];
        }

        // 3. レスポンスの設定（CSVとしてダウンロードさせる）
        $filename = 'contacts_' . date('YmdHis') . '.csv';
        $callback = function () use ($csvHeader, $csvData) {
            $file = fopen('php://output', 'w');
            // 文字化け防止（Excel用）
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
