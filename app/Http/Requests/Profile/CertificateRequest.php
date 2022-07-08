<?php

namespace App\Http\Requests\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    public function rules()
    {
        return [
            "title" => "required|max:255",
            "issuer" => "required|max:255",
            "giving_date" => "required|date|before_or_equal:" . Carbon::now()->format('d.m.Y'),
            "finish_date" => "nullable|date|after:" . $this->giving_date . "|before_or_equal:" . Carbon::now()->format('d.m.Y'),
        ];
    }
}
