<?php

namespace App\Http\Requests\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DebitRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $date = format_date($this->date, 'Y-m-d');
        $desc = $this->desc == 'null' ? null : $this->desc;
        $this->merge([
            'date' => $date,
            'desc' => $desc
        ]);
    }

    public function rules()
    {
        $rules = [
            'inventory_id' => "required",
            'date' => "required|date",
            'inventory_photo' => "nullable|max:1024|mimes:jpg,png,jpeg,bmp",
            'desc' => "nullable|max:500",
        ];

        $this->method() == 'put' ? $rules['status'] = "required" : '';

        return $rules;
    }
}
