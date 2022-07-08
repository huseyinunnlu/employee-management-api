<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MusteriRequest extends FormRequest
{

    public function rules()
    {
        return [
            "title" => "required|max:255",
            "address" => "nullable|max:255",
            "zipcode" => "nullable|max:255",
            "phone" => "nullable|max:255",
            "fax" => "nullable|max:255",
            "email" => "nullable|email|max:255",
            "tax" => "nullable|max:255",
            "tax_no" => "nullable|max:255",
            "website" => "nullable|url|max:255",
            "workplace_registration_number" => "nullable|max:255",
            "registration_no" => "nullable|max:255",
            "iban" => "nullable|max:255",
        ];
    }
}
