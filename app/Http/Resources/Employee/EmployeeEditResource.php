<?php

namespace App\Http\Resources\Employee;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "musteri_id" => $this->musteri_id,
            "role_id" => $this->role_id,
            "company_id" => $this->company_id,
            "department_id" => $this->department_id,
            "employeer_branch_id" => $this->employeer_branch_id,
            "position_id" => $this->position_id,
            "manager_id" => $this->manager_id,
            "work_place_id" => $this->work_place_id,
            "job_id" => $this->job_id,
            "insurance_no" => $this->insurance_no,
            "start_date" => Carbon::parse($this->start_date)->format(config('app.date_format')),
            "birthday" => Carbon::parse($this->birthday)->format(config('app.date_format')),
            "work_type" => $this->work_type,
            "work_status" => $this->work_status,
            "insurance_status" => $this->insurance_status,
            "language_id" => $this->language_id,
            "businness_arragnment_type" => $this->arrangment_end_date ? 'certain' : 'uncertain',
            "arrangment_end_date" => $this->arrangment_end_date ? Carbon::parse($this->arrangment_end_date)->format(config('app.date_format')) : null,
            "disability_status" => $this->disability_status,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "id_number" => $this->id_number,
            "id_serie_number" => $this->id_serie_number,
            "email" => $this->email,
            "registration_number" => $this->registration_number,
            "can_sign_in" => $this->can_sign_in == 0 ? false : true,
            "can_edit_profile" => $this->can_edit_profile == 0 ? false : true,
            "can_edit_email" => $this->can_edit_email == 0 ? false : true,
            "can_see_salary" => $this->can_see_salary == 0 ? false : true,
        ];
    }
}
