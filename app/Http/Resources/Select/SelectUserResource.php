<?php

namespace App\Http\Resources\Select;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectUserResource extends JsonResource
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
            'id' => $this->id,
            'slug' => $this->slug,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'photo' => env('ASSET_URL') . $this->photo,
            "role" => [
                "role_id" => $this->role_id,
                "role" => $this->whenLoaded('role')->current_title,
            ],
            "email" => $this->email,
        ];
    }
}
