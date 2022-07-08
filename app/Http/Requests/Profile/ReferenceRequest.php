<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReferenceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|max:255',
            'work_place_name' => 'required|max:255',
            'experience' => 'nullable|max:255',
            'phone' => 'nullable|numeric|digits:10',
        ];
    }
}
