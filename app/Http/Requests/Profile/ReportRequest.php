<?php

namespace App\Http\Requests\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReportRequest extends FormRequest
{
    public function prepareForValidation()
    {
        if ($this->date) {
            $this['date'] = explode(',', $this->date);
        }
    }

    public function rules()
    {
        $rules = [
            'issuer' => "required|max:255",
            'desc' => "nullable|max:500",
            "date.*" => "required|date|after_or_equal:" . Carbon::now()->format('d.m.Y'),
        ];

        if ($this->method() == 'post') {
            $rules["file"] = "required|file|max:2048|mimes:pdf,doc,docx,xlsx";
        } else if ($this->method() == 'put' && $this->file) {
            $rules["file"] = "required|file|max:2048|mimes:pdf,doc,docx,xlsx";
        }

        return $rules;
    }
}
