<?php

namespace App\Http\Resources\Admin\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class DebitReportResource extends JsonResource
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
            'user' => new ReportUserResource($this->whenLoaded('user')),
            'inventory' => [
                'title' => $this->whenLoaded('inventory')->title,
                'serie' => $this->whenLoaded('inventory')->serie,
                'type' => $this->whenLoaded('inventory')->type->title,
            ],
            'date' => format_date($this->date, config('app.date_format')),
            'desc' => $this->desc,
            'status' => $this->status,
            'created_ad' => format_date($this->created_at, config('app.date_time_format')),
        ];
    }
}
