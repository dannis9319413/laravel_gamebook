<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersInfoRequest extends FormRequest
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
            'email' => 'required|max:255', 'name' => 'max:255',
            'phone' => 'max:30', 'mobile' => 'max:30', 'address' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '請輸入Email', 'email.max' => 'Email長度不得超過255字元', 'name.max' => '姓名長度不得超過255字元',
            'phone.max' => '電話長度不得超過30字元', 'mobile.max' => '手機長度不得超過30字元', 'address.max' => '地址長度不得超過255字元',
        ];
    }
}
