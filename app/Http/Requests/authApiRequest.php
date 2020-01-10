<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class authApiRequest extends FormRequest
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
        return  [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '使用者不能為空!!',
            'name.string' => '使用者型態錯誤!!',
            'name.max' => '使用者長度錯誤!!',
            'email.required'  => 'email不能為空!!',
            'email.string' => 'email型態錯誤!!',
            'email.email' => 'email格式錯誤!!',
            'password.required'  => 'password不能為空!!',
        ];
    }

}
