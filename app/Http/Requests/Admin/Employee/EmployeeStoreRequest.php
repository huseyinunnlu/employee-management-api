<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EmployeeStoreRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules =  [
            "role_id" => "required",
            "musteri_id" => "required",
            "company_id" => "required",
            "department_id" => "nullable",
            "employeer_branch_id" => "required",
            "position_id" => "nullable",
            "manager_id" => "nullable",
            "work_place_id" => "nullable",
            "job_id" => "nullable",
            "insurance_no" => "nullable|numeric|digits:14|unique:users,insurance_no," . $this->id,
            "start_date" => "required|before_or_equal:" . get_current_date(config('app.date_format')),
            "birthday" => "required",
            "work_type" => "required",
            "work_status" => "required",
            "insurance_status" => "required",
            "language_id" => "required",
            "businness_arragnment_type" => "required",
            "arrangment_end_date" => "required_if:busbusinness_arragnment_type,certain",
            "disability_status" => "required",
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "id_number" => "required|numeric|unique:users,id_number," . $this->id . "|digits:11",
            "id_serie_number" => "nullable|max:9|min:9|unique:users,id_serie_number," . $this->id,
            "email" => "required|email|unique:users,email," . $this->id,
            "registration_number" => "nullable|numeric|digits_between:1,11|unique:users,registration_number," . $this->id,
            "can_sign_in" => "required|boolean",
            "can_edit_profile" => "required|boolean",
            "can_edit_email" => "required|boolean",
            "can_see_salary" => "required|boolean",
        ];

        !$request->isMethod('put') ? $rules['password'] = "required|min:6|max:35" : '';

        return $rules;
    }
}
