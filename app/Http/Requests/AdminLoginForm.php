<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginForm extends FormRequest
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
            'email' => 'required',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'กรุณากรอกที่อยู่อีเมลของคุณ',
            'password.required' => 'กรุณากรอกรหัสผ่านของคุณ',
            'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว',
        ];
    }
}
