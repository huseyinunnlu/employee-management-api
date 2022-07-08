<?php

namespace App\Http\Resources\Profile;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray($request)
    {
        $start_date = Carbon::parse($this->start_date)->format(config('app.date_format'));
        $end_date = Carbon::parse($this->end_date)->format(config('app.date_format'));
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "desc" => $this->desc,
            "url" => env('ASSET_URL') . $this->url,
            "title" => $this->title,
            "date" => $start_date . ' - ' . $end_date,
            "dates" => [
                "start_date" => $start_date,
                "end_date" => $end_date,
            ],
            "issuer" => $this->issuer,
            "created_at" => Carbon::parse($this->created_at)->format(config('app.date_time_format')),
        ];
    }
}
