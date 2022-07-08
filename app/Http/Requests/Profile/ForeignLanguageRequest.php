<?php

namespace App\Http\Requests\Profile;

use App\Rules\UniqueForOneData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ForeignLanguageRequest extends FormRequest
{
    public function rules(Request $request)
    {
        return [
            "language_id" => ["required", new UniqueForOneData($request->route()->parameter('user'))],
            "status" => "required",
        ];
    }
}
