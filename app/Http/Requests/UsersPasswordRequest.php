<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersPasswordRequest extends FormRequest
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
            'password' => 'required|max:30', 'new_password' => 'required|max:30', 'confirm_password' => 'required|max:30'
        ];
    }

    public function messages()
    {
        return ['password.required' => '請輸入當前密碼', 'password.max' => '當前密碼不得超過30字元', 'new_password.required' => '請輸入新密碼', 'new_password.max' => '新密碼不得超過30字元', 'confirm_password.required' => '請輸入確認密碼', 'confirm_password.max' => '確認密碼不得超過30字元'];
    }
}
