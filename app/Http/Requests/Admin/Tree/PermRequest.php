<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PermRequest extends FormRequest
{
    public function rules()
    {
        return [
            'column' => 'required',
            'id' => 'required',
            'form' => 'required|array',
            'form.*' => 'required|integer'
        ];
    }
}
