<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AbsenceTypeRequest extends FormRequest
{
    public function rules()
    {
        return [
            "absenceTypes.*.title" => "required|max:255",
            "absenceTypes.*.lang_code" => "required",
        ];
    }
}
