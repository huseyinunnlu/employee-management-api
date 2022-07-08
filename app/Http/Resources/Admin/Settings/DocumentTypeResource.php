<?php

namespace App\Http\Resources\Admin\Settings;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeResource extends JsonResource
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
            "title" => $this->current_title,
            "created_at" => $this->created_at ? date('d.m.Y H:i', strtotime($this->created_at)) : null,
            "titles" => $this->whenLoaded('titles'),
        ];
    }
}
