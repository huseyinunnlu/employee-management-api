<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $type = $this->whenLoaded('type') ?? null;
        $title = $this->serial ? $this->title . '(' . $this->serial . ')' : $this->title;
        return [
            'id' => $this->id,
            'title' => $title,
            'serial' => $this->serial,
            'type' => $type ? [
                'id' => $type->id,
                'title' => $type->title,
            ] : null,
            'created_at' => Carbon::parse($this->created_at)->format(config('app.date_time_format'))
        ];
    }
}
