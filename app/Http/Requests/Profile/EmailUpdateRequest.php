<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class EmailUpdateRequest extends FormRequest
{
    public function rules(Request $request)
    {
        return [
            "email" => "required|max:255|email|unique:users,email" . $request->route()->parameter('id'),
        ];
    }
}
