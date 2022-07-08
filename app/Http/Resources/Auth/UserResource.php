<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "full_name" => get_full_name($this->first_name, $this->last_name),
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "personal_no" => $this->personal_no,
            "photo" => generate_file_url($this->photo),
            "role" => [
                "role_id" => $this->role_id,
                "role" => $this->whenLoaded('role')->current_title ?? null,
            ],
            "perms" => [
                "can_sign_in" => convert_mysql_to_normal_boolean($this->can_sign_in),
                "can_edit_profile" => convert_mysql_to_normal_boolean($this->can_edit_profile),
                "can_edit_email" => convert_mysql_to_normal_boolean($this->can_edit_email),
                "can_see_salary" => convert_mysql_to_normal_boolean($this->can_see_salary),
            ],
            "company" => [
                'id' => $this->company_id,
            ],
            "slug" => $this->slug,
            "status" => "active",
            "created_at" => format_date($this->created_at, config('app.date_time_format')),
            "updated_at" => format_date($this->updated_at, config('app.date_time_format')),
            "work_status" => "full",
        ];
    }
}
