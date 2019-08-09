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
            'image' => 'required|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'กรุณาเลือกไฟล์ของคุณ',
            'image.mimetypes' => 'รองรับไฟล์ jpeg,png เท่านั้น',
        ];
    }
}
