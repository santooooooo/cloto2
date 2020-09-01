<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:10',
            'email' => 'required|email',
            'upload_image'     => 'nullable|image',
            'introduction' => 'nullable|string'
        ];
    }

    /**
     * Set the error message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required'     => 'ユーザー名は必須です．',
            'username.string'       => 'ユーザー名は文字列を入力してください．',
            'username.max'          => 'ユーザー名は:max文字以内で入力してください．',
            'email.required' => 'メールアドレスは必須です．',
            'email.email' => 'メールアドレスの形式が不正です．',
            'upload_image.image'        => 'アイコンアップロードエラー．',
            'introduction.string' => '自己紹介には文字列を入力してください．'
        ];
    }
}
