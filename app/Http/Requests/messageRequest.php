<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class messageRequest extends FormRequest
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
            'user_id' => 'required',
            'content' => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => '使用者不能為空!!',
            'content.required'  => '發送留言不能為空!!',
            'content.min'  => '發送留言不能為小於5個字!!'
        ];
    }

}
