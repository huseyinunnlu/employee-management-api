<?php

namespace App\Http\Resources\Admin\Tree;

use Illuminate\Http\Resources\Json\JsonResource;

class MainCompanyResource extends JsonResource
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
            'logo' => $this->logo ? env('ASSET_URL') . $this->logo : null,
            'title' => $this->title,
            'email' => $this->email,
            'address' => $this->address,
            'city_id' => $this->city_id,
            'country_id' => $this->whenLoaded('city')->country_id,
            'city' => $this->whenLoaded('city')->title . '/' . $this->whenLoaded('city')->country->current_title,
        ];
    }
}
