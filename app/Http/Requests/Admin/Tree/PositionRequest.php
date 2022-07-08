<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PositionRequest extends FormRequest
{
    public function rules()
    {
        return [
            "positions" => "required|array",
            "positions.*.title" => "required|max:255",
            "positions.*.lang_code" => "required",
        ];
    }
}
