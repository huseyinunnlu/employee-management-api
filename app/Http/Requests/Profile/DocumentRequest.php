<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DocumentRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $see_document = $this->is_see_document == 'true' ? true : false;
        $this->merge([
            'is_see_document' => $see_document,
        ]);
    }

    public function rules()
    {
        $rules = [
            "type_id" => "required",
            "desc" => "nullable|max:500",
            "is_see_document" => "required|boolean",
        ];

        if ($this->method() == 'post' && $this->file) {
            $rules["file"] = "required|file|max:2048|mimes:doc,docx,pdf,xlsx,jpg,jpeg,bmp,webp";
        } else if ($this->method() == 'put' && $this->file) {
            $rules["file"] = "required|file|max:2048|mimes:doc,docx,pdf,xlsx,jpg,jpeg,bmp,webp";
        }

        return $rules;
    }
}
