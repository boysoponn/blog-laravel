<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordForm extends FormRequest
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
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmpassword' => 'required|same:newpassword|min:8',
        ];
    }

    public function messages()
    {
        return [
            'oldpassword.required' => 'กรุณากรอกรหัสผ่านของคุณ',
            'newpassword.required' => 'กรุณากรอกรหัสผ่านใหม่ของคุณ/อย่างน้อย 8 ตัว',
            'confirmpassword.required' => 'การยืนยันรหัสผ่านใหม่ของคุณไม่ถูกต้อง',
            'newpassword.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว',
            'confirmpassword.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว',
            'confirmpassword.same' => 'รหัสผ่านใหม่ไม่เหมือนกัน',
        ];
    }
}
