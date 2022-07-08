<?php

namespace App\Http\Resources\Select;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectJobResource extends JsonResource
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
            'title' => $this->code . ' ' .  $this->current_title,
        ];
    }
}
