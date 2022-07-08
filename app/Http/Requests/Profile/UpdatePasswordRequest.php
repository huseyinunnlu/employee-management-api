<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            "current_password" => "required|max:255",
            "password" => "required|min:6|max:30|confirmed|different:current_password",
            "password_confirmation" => "required|min:6|max:30",
        ];
    }
}
