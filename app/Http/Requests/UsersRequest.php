<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'email' => 'required|max:255', 'password' => 'required|max:255', 'confirm_password' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return ['email.required' => '請輸入Email', 'title.max' => 'Email不得超過255字元', 'password.required' => '請輸入密碼', 'password.max' => '密碼不得超過255字元', 'confirm_password.required' => '請輸入確認密碼', 'confirm_password.max' => '確認密碼不得超過255字元'];
    }
}
