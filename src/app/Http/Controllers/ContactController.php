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

        // 電話番号結合
        $inputs['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        // お問い合わせの種類（表示用）
        $category = Category::find($inputs['category_id']);
        $inputs['category_content'] = $category ? $category->content : '';

        return view('contact.contact_confirm', compact('inputs'));
    }

    // 保存処理
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        Contact::create($request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
        ]));

        return redirect('/thanks');
    }

    // サンクス画面
    public function thanks()
    {
        return view('contact.contact_thanks');
    }
}
