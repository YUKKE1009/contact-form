<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    // 入力画面
    public function index()
    {
        $categories = Category::all();
        return view('contact.contact_form', compact('categories'));
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
}
