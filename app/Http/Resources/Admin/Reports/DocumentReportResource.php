<?php

namespace App\Http\Resources\Admin\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $file = $this->whenLoaded('document');
        $is_have = !is_null($file);
        return [
            'id' => $this->id,
            'full_name' => get_full_name($this->first_name, $this->last_name),
            'slug' => $this->slug,
            'company' => $this->whenLoaded('company')->title ?? null,
            'department' => $this->whenLoaded('department')->title ?? null,
            'file' => [
                'is_have' => $is_have,
                'file_id' => $is_have ? $file->id : null,
                'file' => $is_have ? $file->url : null,
                'title' => $is_have ? $file->title : null,
                'type' => $file ? $file->type->current_title : null,
                'created_at' => $is_have ? format_date($file->created_at, config('app.date_time_format')) : null,
            ],
        ];
    }
}
