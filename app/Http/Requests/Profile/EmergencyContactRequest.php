<?php

namespace App\Http\Requests\Profile;

use App\Exceptions\CrudException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmergencyContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            "full_name" => "required|max:255",
            "phone" => "required|numeric|digits:10",
        ];
    }
}
