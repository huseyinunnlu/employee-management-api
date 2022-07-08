<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ExpenseLineRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules = [
            'date' => 'required|date',
            'desc' => 'nullable|max:500',
            'file' => 'nullable',
            'price' => 'required|numeric',
            'type_id' => 'required',
        ];

        if ($request->hasFile('file')) {
            $rules['file'] = 'required|file|max:2048|mimes:jpg,png,jpeg,bmp,docx,pdf,xlsx';
        }

        return $rules;
    }
}
