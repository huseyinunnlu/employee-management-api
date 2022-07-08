<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => "required|required|max:255",
            'serial' => "nullable|max:30",
            'type_id' => "required"
        ];
    }
}
