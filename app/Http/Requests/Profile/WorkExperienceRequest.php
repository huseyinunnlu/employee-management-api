<?php

namespace App\Http\Requests\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WorkExperienceRequest extends FormRequest
{

    public function rules()
    {
        return [
            'work_place_name' => 'required|max:255',
            'experience' => 'required|max:255',
            'start_date' => 'required|date|before_or_equal:' . Carbon::now()->format(config('app.date_format')),
            'leave_date' => 'nullable|date|after:' . format_date($this->start_date, config('app.date_format')) . "|before_or_equal:" . Carbon::now()->format(config('app.date_format')),
            'leave_reason' => 'nullable|max:255',
        ];
    }
}
