<?php

namespace App\Http\Resources\Admin\Tree;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkPlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $department = $this->whenLoaded('department');
        $city = $this->whenLoaded('city');
        return [
            'id' => $this->id,
            'company_id' => $department->company->id,
            'musteri_id' => $department->company->musteri_id,
            'department' => [
                'id' => $department->id,
                'title' => $department->title,
            ],
            'city' => [
                'id' => $city->id,
                'title' => $city->title,
                'country_id' => $city->country_id,
                'country' => $city->country->current_title,
            ],
            'title' => $this->title,
            'email' => $this->email,
            'working_hours' => [
                'morning' => [
                    'start_time' => $this->morning_start_time,
                    'end_time' => $this->morning_end_time,
                    'break_time' => $this->morning_break,
                ],
                'afternoon' => [
                    'start_time' => $this->afternoon_start_time,
                    'end_time' => $this->afternoon_end_time,
                    'break_time' => $this->afternoon_break,
                ],
                'night' => [
                    'start_time' => $this->night_start_time,
                    'end_time' => $this->night_end_time,
                    'break_time' => $this->night_break,
                ],
                'full' => [
                    'start_time' => $this->full_start_time,
                    'end_time' => $this->full_end_time,
                    'break_time' => $this->full_break,
                ],
                'report' => [
                    'start_time' => $this->report_start_time,
                    'end_time' => $this->report_end_time,
                    'break_time' => $this->report_break,
                ],
                'permit' => [
                    'start_time' => $this->permit_start_time,
                    'end_time' => $this->permit_end_time,
                    'break_time' => $this->permit_break,
                ],
                'annual' => [
                    'start_time' => $this->annual_permit_start_time,
                    'end_time' => $this->annual_permit_end_time,
                    'break_time' => $this->annual_permit_break,
                ],
            ],
            'created_at' => Carbon::parse($this->created_at)->format(config('app.date_time_format')),
        ];
    }
}
