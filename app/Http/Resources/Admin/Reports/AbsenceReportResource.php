<?php

namespace App\Http\Resources\Admin\Reports;

use App\Http\Resources\ApiSelectDataResource;
use App\Models\Absence;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsenceReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $start_date = Carbon::parse($this->start_date);
        $end_date = Carbon::parse($this->end_date);
        $start_time = $this->start_time ? Carbon::parse($this->start_time) : null;
        $end_time = $this->end_time ? Carbon::parse($this->end_time) : null;

        $day_count = 0;
        if ($this->day_type == 'full') {
            $day_count = $start_date->diffInDays($end_date) + 1;
        } else {
            $day_count = 0.5;
        }

        if ($this->start_time && $this->end_time) {
            $formatted_date = $start_date->format(config('app.date_format')) . ' - ' . $end_date->format(config('app.date_format')) . ' <br> ' . $start_time->format('H:i') . ' - ' . $end_time->format('H:i');
            $start_time = $start_time->format('H:i');
            $end_time = $end_time->format('H:i');
        } else {
            $formatted_date = $start_date->format(config('app.date_format')) . ' - ' . $end_date->format(config('app.date_format'));
        }

        $user = $this->whenLoaded('user');


        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => [
                'slug' => $user->slug,
                'full_name' => $user->first_name . ' ' . $user->last_name,
                'company' => $user->company->title,
                'department' => $user->department->title ?? null,
            ],
            'type' => new ApiSelectDataResource($this->whenLoaded('type')),
            'place' => $this->place,
            'day_type' => $this->day_type,
            'contact_phone' => $this->contact_phone,
            'date' => $formatted_date,
            'dates' => [
                'start_date' => $start_date->format(config('app.date_format')),
                'end_date' => $end_date->format(config('app.date_format')),
                'start_time' => $start_time,
                'end_time' => $end_time,
            ],
            'day_count' => $day_count,
            'status' => [
                'color' => config('enums.status_color' . $this->status),
                'text' => $this->status
            ],
            'is_signed' => $this->is_signed == 1 ? true : false,
        ];
    }
}
