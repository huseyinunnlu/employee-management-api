<?php

namespace App\Http\Resources\Profile;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            "type_title" => $this->whenLoaded('type')->current_title,
            "type_id" => $this->type_id,
            "title" => $this->title,
            "url" => env('ASSET_URL') . $this->url,
            "user_id" => $this->user_id,
            "desc" => $this->desc,
            "is_see_document" => $this->is_see_document == 1 ? true : false,
            "created_at" => Carbon::parse($this->created_at)->format(config('app.date_time_format')),
            "updated_at" => Carbon::parse($this->updated_at)->format(config('app.date_time_format')),
        ];
    }
}
