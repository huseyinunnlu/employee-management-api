<?php

namespace App\Http\Resources\Admin\Reports;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticUserResource extends JsonResource
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

            "full_name" => $this->first_name . ' ' . $this->last_name,
            "role" => [
                "role_id" => $this->role_id,
                "role" => $this->whenLoaded('role')->current_title,
            ],
            "age_range" => $this->age_range,
            "age" => $this->age,
            "company" => $this->whenLoaded('company'),

        ];
    }
}
