<?php

namespace App\Http\Resources\Admin\Tree;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
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
            'title' => $this->current_title,
            'department' => [
                'id' => $this->department_id,
                'title' => $this->whenLoaded('department')->title,
            ],
            'titles' => $this->whenLoaded('titles'),
            'created_at' => Carbon::parse($this->created_at)->format(config('app.date_time_format')),
        ];
    }
}
