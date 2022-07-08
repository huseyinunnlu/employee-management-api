<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TitleUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            "title" => "required|max:255",
        ];
    }
}
