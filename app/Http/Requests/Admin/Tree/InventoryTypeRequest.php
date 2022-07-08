<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InventoryTypeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255',
        ];
    }
}
