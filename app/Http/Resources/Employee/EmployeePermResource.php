<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Employee\EmployeePermResource as EmployeeResource;

class EmployeePermResource extends JsonResource
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
            'id' => $this->title,
            'title' => $this->current_title ?? $this->title,
            'child' => EmployeeResource::collection($this->whenLoaded('work_places')),
            'child' => EmployeeResource::collection($this->whenLoaded('departments')),
        ];
    }
}
