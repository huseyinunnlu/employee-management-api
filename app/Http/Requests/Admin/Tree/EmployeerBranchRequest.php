<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeerBranchRequest extends FormRequest
{
    public function rules()
    {
        return [
            "employeer_title" => "required|max:255",
            "tax" => "required|max:255",
            "tax_no" => "required|max:255",
            "website" => "nullable|url|max:255",
            "workplace_registration_number" => "required|max:255",
            "commercial_registration_number" => "required|max:255",
            "address" => "required|max:500",
        ];
    }
}
