<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ExpenseRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules = [
            'status' => 'required',
            'notes' => 'nullable|max:500',
        ];

        $store_rules = [
            'user_id' => 'required',
            'lines' => 'required|array|min:1',
            'lines.*.date' => 'required|date',
            'lines.*.desc' => 'nullable|max:500',
            'lines.*.file' => 'nullable|file|max:2048|mimes:jpg,png,jpeg,bmp,docx,pdf,xlsx',
            'lines.*.price' => 'required|numeric|digits:11',
            'lines.*.type_id' => 'required',
        ];

        if ($request->getMethod() === 'post') {
            $rules = array_merge($rules, $store_rules);
        }

        return $rules;
    }
}
