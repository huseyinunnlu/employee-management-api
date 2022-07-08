<?php

namespace App\Http\Resources\Admin\Tree;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'musteri_id' => $this->musteri_id,
            'title' => $this->title,
            'city' => $this->whenLoaded('city')->title,
        ];
    }
}
