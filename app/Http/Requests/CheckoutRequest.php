<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|max:255', 'mobile' =>
            'required|max:255', 'email' =>
            'required|max:255', 'zipcode' =>
            'required', 'county' =>
            'required', 'district' =>
            'required', 'address' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '請輸入姓名', 'name.max' => '姓名不得超過255字元',
            'mobile.required' => '請輸入行動電話', 'mobile.max' => '行動電話不得超過255字元',
            'email.required' => '請輸入Email', 'email.max' => 'Email不得超過255字元',
            'zipcode.required' => '請選擇縣市與區域',
            'county.required' => '請選擇縣市',
            'district.required' => '請選擇區域',
            'address.required' => '請輸入地址', 'address.max' => '地址不得超過255字元'
        ];
    }
}
