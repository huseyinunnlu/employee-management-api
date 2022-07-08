<?php

namespace App\Http\Resources\Admin\Tree;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
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
            "user_id" => $this->id,
            "slug" => $this->slug,
            "full_name" => $this->first_name . ' ' . $this->last_name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "role" => [
                "role_id" => $this->role_id,
                "role" => $this->whenLoaded('role')->current_title,
            ],
            "department" => $this->whenLoaded('department')->title ?? '-',
            "company" => $this->whenLoaded('company')->title ?? '-',
            "start_date" => $this->start_date ? date('d.m.Y', strtotime($this->start_date)) : null,
        ];
    }
}
