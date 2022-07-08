<?php

namespace App\Http\Requests\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EducationInfoRequest extends FormRequest
{
    public function rules()
    {
        return [
            "status" => "required",
            "file" => "nullable|file|max:2048|mimes:pdf,doc,docx,xlsx,jpeg,png,jpg,bmp,webp",
            "graduated_school" => "required|max:255",
            "department" => "nullable|max:255",
            "start_year" => "required|max:4|min:4|digits:4|lte:finish_year|before_or_equal:" . Carbon::now()->format('Y'),
            "finish_year" => "required|max:4|min:4|digits:4|gte:start_year|before:" . Carbon::now()->format('Y'),
            "cerifticate_grade" => "nullable|max:11"
        ];
    }
}
