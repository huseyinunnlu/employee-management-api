<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfessionalFieldRequest extends FormRequest
{
    public function rules()
    {
        return [
            "position_id" => "required",
            "location_id" => "required"
        ];
    }
}
