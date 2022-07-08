<?php

namespace App\Http\Requests\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class UpdatePersonalInfoRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $birthday = Carbon::parse($this->birthday)->format('Y-m-d');
        $licence_date = $this->licence_date ? Carbon::parse($this->licence_date)->format('Y-m-d') : null;
        $tgb_start_date = $this->tgb_start_date ? Carbon::parse($this->tgb_start_date)->format('Y-m-d') : null;


        $this->merge([
            'birthday' => $birthday,
            'licence_date' => $licence_date,
            'tgb_start_date' => $tgb_start_date,
        ]);
    }

    public function rules(Request $request)
    {
        return [
            "id" => "required|max:11",
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "born_place_id" => "required",
            "birthday" => "required|date|before_or_equal:" . Carbon::now()->format('d.m.Y'),
            "gender" => "required",
            "nation_id" => "required",
            "licences" => "nullable|array",
            "work_status" => "required",
            "work_days" => "nullable|array",
            "licence_date" => "nullable",
            "military_status" => "nullable",
            "iban" => "nullable|numeric|digits:24",
            "id_number" => "required|numeric|min:0|digits:11|unique:users,id_number," . $this->id,
            "id_serie_number" => "nullable|max:9|min:9|unique:users,id_serie_number," . $this->id,
            "blood_grup" => "nullable",
            "mariance_status" => "required",
            "is_smoking" => "nullable",
            "father_name" => "nullable|max:255",
            "mother_name" => "nullable|max:255",
            "important_or_surgeon" => "nullable|max:500",
            "address" => "nullable|max:1500",
            "city_id" => "required",
            "home_phone" => "nullable|numeric|digits:10",
            "personal_phone" => "nullable|numeric|digits:10",
            "work_phone" => "nullable|numeric|digits:10",
            "whatsapp_phone" => "nullable|numeric|digits:10",
            "pdks_id" => "nullable|max:255",
            "exempt_rate" => "nullable|numeric|max:100",
            "tgb_start_date" => "nullable|date|before_or_equal:" . Carbon::now()->format(config('app.date_format')),
        ];
    }
}
