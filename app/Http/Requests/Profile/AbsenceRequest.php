<?php

namespace App\Http\Requests\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AbsenceRequest extends FormRequest
{
    public function prepareForValidation()
    {
        if ($this->date[0] != $this->date[1]) {
            $this['day_type'] = 'full';
        }
        if ($this->day_type != "hourly") {
            $this['start_time'] = null;
            $this['end_time'] = null;
        }
    }

    public function rules()
    {
        return [
            "type_id" => "required",
            "date.*" => "required|date",
            "date.0" => "before_or_equal:" . $this->date[1] . "|after_or_equal:" . get_current_date(config('app.date_format')),
            "date.1" => "after_or_equal:" . $this->date[0] . "|after_or_equal:" . get_current_date(config('app.date_format')),
            "day_type" => "required",
            "start_time" => "required_if:day_type,hourly",
            "end_time" => "required_if:day_type,hourly",
            "status" => "required",
            "contact_phone" => "nullable|numeric|digits:10",
            "place" => "nullable|max:255",
            "status" => "required",
        ];
    }
}
