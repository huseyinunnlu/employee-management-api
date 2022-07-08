<?php

namespace App\Http\Requests\Absence;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AbsenceStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            "date.start_date" => "required|after_or_equal:" . date('d-m-Y'),
            "date.end_date" => "required|after_or_equal:" . date('d-m-Y'),
            "days.*" => "required",
            "end_time" => "required",
            "start_time" => "required",
            "notes" => "nullable|max:255",
            "type_id" => "required",
            "user_id" => "required"
        ];
    }
}
