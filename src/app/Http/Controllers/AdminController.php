<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // 1. カテゴリ一覧を取得（検索窓のプルダウン用）
        $categories = Category::all();

        // 2. 検索クエリの作成
        $query = Contact::query()->with('category');

        // --- ここに検索ロジックを入れる（任意） ---
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }
        // ---------------------------------------

        // 3. ページネーションを実行
        $contacts = $query->paginate(7);

        // 4. ビューに $contacts と $categories の両方を渡す
        return view('admin.index', compact('contacts', 'categories'));
    }
}
