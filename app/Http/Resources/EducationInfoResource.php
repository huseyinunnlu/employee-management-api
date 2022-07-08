<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationInfoResource extends JsonResource
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
            "id" => $this->id,
            "user_id" => $this->user_id,
            "department" => $this->department,
            "url" => generate_file_url($this->url),
            "graduated_school" => $this->graduated_school,
            "status" => $this->status,
            "certificate_grade" => $this->certificate_grade,
            "start_year" => $this->start_year,
            "finish_year" => $this->finish_year,
            "title" => $this->title,
            "created_at" => format_date($this->created_at, config('app.date_time_format')),
        ];
    }
}
