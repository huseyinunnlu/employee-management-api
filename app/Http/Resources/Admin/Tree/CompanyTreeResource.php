<?php

namespace App\Http\Resources\Admin\Tree;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CompanyTreeResource extends JsonResource
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
            'data_type' => class_basename($this->resource),
            'toggle_id' => Str::random(40),
            'title' => $this->title ? $this->title : $this->current_title,
            'created_at' => Carbon::parse($this->created_at)->format(config('app.date_time_format')),
            'companies' => CompanyTreeResource::collection($this->whenLoaded('companies')),
            'departments' => CompanyTreeResource::collection($this->whenLoaded('departments')),
            'work_places' => CompanyTreeResource::collection($this->whenLoaded('work_places')),
        ];
    }
}
