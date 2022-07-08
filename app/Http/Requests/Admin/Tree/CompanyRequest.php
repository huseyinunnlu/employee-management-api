<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class CompanyRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules = [
            "title" => "required|max:255",
            "address" => "required|max:500",
            "email" => "required|email|max:255",
            "city_id" => "required"
        ];

        if ($request->isMethod('post')) {
            $rules['permittedUsers'] = "nullable|array";
        }

        if ($request->hasFile('logo')) {
            $rules['logo'] = "required|file|mimes:jpg,png,jpeg,bmp|max:2048";
        } else if ($request->logo) {
            $rules['logo'] = "required";
        }

        return $rules;
    }
}
