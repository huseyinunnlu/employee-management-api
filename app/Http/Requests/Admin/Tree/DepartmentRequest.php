<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            "title" => "required|max:255",
            "city_id" => "required",
            "mountly_holiday" => "required|numeric|max:30|min:0",
            "daily_work_hour" => "required|numeric|max:24",
            "overtime_rate" => "required|numeric",
            "overtime_type" => "required",
            "food_fee_tax" => "required|boolean",
            "road_fee_tax" => "required|boolean",
        ];

        if ($this->isMethod('post')) {
            $rules['permittedUsers'] = "nullable|array";
            $rules['permittedUsers.*'] = "required";
        }

        return $rules;
    }
}
