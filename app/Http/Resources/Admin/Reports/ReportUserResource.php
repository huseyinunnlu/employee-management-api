<?php

namespace App\Http\Resources\Admin\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportUserResource extends JsonResource
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
            'slug' => $this->slug,
            'full_name' => get_full_name($this->first_name, $this->last_name),
            'company' => $this->whenLoaded('company')->title ?? null,
            'company_id' => $this->whenLoaded('company')->id ?? null,
            'department' => $this->whenLoaded('department')->title ?? null,
            'department_id' => $this->whenLoaded('department')->date ?? null,
        ];
    }
}
