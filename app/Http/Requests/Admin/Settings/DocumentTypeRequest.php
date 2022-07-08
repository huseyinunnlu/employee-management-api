<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DocumentTypeRequest extends FormRequest
{
    public function rules()
    {
        return [
            "documentTypes.*.title" => "required|max:255",
            "documentTypes.*.lang_code" => "required",
        ];
    }
}
