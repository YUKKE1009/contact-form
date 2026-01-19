<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    // 認可（今回は常にOK）
    public function authorize()
    {
        return true;
    }

    // バリデーションルール
    public function rules()
    {
        return [
            'category_id' => 'required',
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'gender'      => 'required',
            'email'       => 'required|email',
            'tel'         => 'required',
            'address'     => 'required',
            'detail'      => 'required',
        ];
    }
}
