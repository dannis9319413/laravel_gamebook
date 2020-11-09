<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'folder' => 'required|max:255', 'name' => 'required|max:255', 'description' => 'required', 'price' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return ['folder.required' => '請輸入資料夾', 'folder.max' => '資料夾長度不得超過255字元', 'name.required' => '請輸入遊戲名稱', 'name.max' => '遊戲名稱不得超過255字元', 'description.required' => '請輸入遊戲描述', 'price.required' => '請輸入遊戲價格', 'price.max' => '遊戲價格不得超過255字元'];
    }
}
