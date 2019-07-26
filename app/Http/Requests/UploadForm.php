<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadForm extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'กรุณาเลือกไฟล์ของคุณ',
        ];
    }
}
