<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BanForm extends FormRequest
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
            'time' => 'required|numeric|min:1',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'time.numeric' => 'กรอกตัวเลขเท่านั้น',
            'time.min' => 'จำนวนวันไม่น้อยกว่า 1 วัน',
            'time.required'  => 'ระบุจำนวนวันระงับการใช้งาน',
            'description.required'  => 'กรุณากรอกคำอธิบาย',
        ];
    }
}
