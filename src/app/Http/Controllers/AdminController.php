<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    // 検索ロジックを共通化（1人の時も確実に拾えるように修正）
    private function applySearch(Request $request)
    {
        $query = Contact::query()->with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    // ★ここを追加：姓と名を結合して検索（フルネーム完全一致などに対応）
                    ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ["%{$keyword}%"])
                    // ★ここを追加：苗字と名前の間にスペースがある場合も考慮
                    ->orWhereRaw('CONCAT(last_name, " ", first_name) LIKE ?', ["%{$keyword}%"]);
            });
        }
        $gender = $request->gender;

        if ($gender && $gender !== 'all') {
            $query->where('gender', $gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $query = $this->applySearch($request);
        $contacts = $query->paginate(7);
        return view('admin.index', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->back();
    }

    public function export(Request $request)
    {
        $query = $this->applySearch($request);
        $contacts = $query->get(); // 1人でも複数でも全件取得

        return new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF"); // 文字化け防止
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '詳細内容']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . $contact->first_name,
                    $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                    $contact->email,
                    $contact->category->content ?? '',
                    $contact->detail
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_' . date('Ymd') . '.csv"',
        ]);
    }
}
