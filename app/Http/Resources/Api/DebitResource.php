<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DebitResource extends JsonResource
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
            'user_id' => $this->user_id,
            'inventory' => new InventoryResource($this->whenLoaded('inventory')),
            'date' => Carbon::parse($this->date)->format('d.m.Y'),
            'inventory_photo' => $this->inventory_photo ? env('ASSET_URL') . $this->inventory_photo : null,
            'desc' => $this->desc,
            'status' => $this->status,
        ];
    }
}
