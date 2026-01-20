<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name'   => ['required', 'string', 'max:8'],
            'first_name'  => ['required', 'string', 'max:8'],
            'gender'      => ['required'],
            'email'       => ['required', 'email:filter'],
            // 電話番号が3つに分かれている想定（tel1, tel2, tel3）
            'tel1'        => ['required', 'numeric', 'digits_between:1,5'],
            'tel2'        => ['required', 'numeric', 'digits_between:1,5'],
            'tel3'        => ['required', 'numeric', 'digits_between:1,5'],
            'address'     => ['required'],
            'category_id' => ['required'],
            'detail'      => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            // 1. お名前
            'last_name.required' => '姓を入力してください',
            'last_name.string'   => '姓を文字列で入力してください',
            'last_name.max'      => '姓は8文字以内で入力してください',

            'first_name.required' => '名を入力してください',
            'first_name.string'   => '名を文字列で入力してください',
            'first_name.max'      => '名は8文字以内で入力してください',

            // 2. 性別
            'gender.required'      => '性別を選択してください',

            // 3. メールアドレス
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',

            // 4. 電話番号 (各ボックスに対して同じメッセージを適用)
            // tel1 だけに代表してメッセージを設定する
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel1.numeric'  => '電話番号は半角数字で入力してください',
            'tel2.numeric'  => '電話番号は半角数字で入力してください',
            'tel3.numeric'  => '電話番号は半角数字で入力してください',
            'tel1.digits_between' => '電話番号は5桁以内で入力してください',
            'tel2.digits_between' => '電話番号は5桁以内で入力してください',
            'tel3.digits_between' => '電話番号は5桁以内で入力してください',

            // 5. 住所
            'address.required'     => '住所を入力してください',

            // 7. お問い合わせの種類
            'category_id.required' => 'お問い合わせの種類を選択してください',

            // 8. お問い合わせの内容
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
