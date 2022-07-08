<?php

namespace App\Http\Resources\Profile;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
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
            "title" => $this->title,
            "issuer" => $this->issuer,
            "giving_date" => format_date($this->giving_date, config('app.date_format')),
            "finish_date" => format_date($this->finish_date, config('app.date_format')),
        ];
    }
}
