<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalFieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $position = $this->whenLoaded('position');
        $location = $this->whenLoaded('location');
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'location' => [
                'id' => $location->id,
                'title' => $location->title . ' / ' . $location->city->title
            ],
            'position' => [
                'id' => $position->id,
                'title' => $position->current_title,
            ],
            "created_at" => $this->created_at ? date('d.m.Y H:i', strtotime($this->created_at)) : null,
            "updated_at" => $this->updated_at ? date('d.m.Y H:i', strtotime($this->updated_at)) : null,
        ];
    }
}
