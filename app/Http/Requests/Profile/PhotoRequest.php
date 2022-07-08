<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PhotoRequest extends FormRequest
{
    public function rules()
    {
        return [
            "photo" => "required|mimes:png,jpg,jpeg,bmp|max:1024",
        ];
    }
}
