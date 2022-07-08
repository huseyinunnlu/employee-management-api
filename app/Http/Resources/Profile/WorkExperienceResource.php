<?php

namespace App\Http\Resources\Profile;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkExperienceResource extends JsonResource
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
            'work_place_name' => $this->work_place_name,
            'experience' => $this->experience,
            'start_date' => format_date($this->start_date, config('app.date_format')),
            'leave_date' => format_date($this->leave_date, config('app.date_format')),
            'leave_reason' => $this->leave_reason,
        ];
    }
}
