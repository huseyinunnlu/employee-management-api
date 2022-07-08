<?php

namespace App\Http\Resources\Admin\Tree;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $company = $this->whenLoaded('company');
        $city = $this->whenLoaded('city');
        return [
            'id' => $this->id,
            'company' => [
                'id' => $company->id,
                'title' => $company->title,
                'musteri_id' => $company->musteri_id,
            ],
            'city' => [
                'id' => $city->id,
                'country_id' => $city->country->id,
                'title' => $city->title . ' / ' . $city->country->current_title
            ],
            'title' => $this->title,
            'mountly_holiday' => $this->mountly_holiday,
            'daily_work_hour' => $this->daily_work_hour,
            'overtime_rate' => $this->overtime_rate,
            'overtime_type' => $this->overtime_type,
            'food_fee_tax' => $this->food_fee_tax == 1 ? true : false,
            'road_fee_tax' => $this->road_fee_tax == 1 ? true : false,
            'created_at' => Carbon::parse($this->created_at)->format(config('app.date_time_format')),
        ];
    }
}
