<?php

namespace App\Http\Resources\Admin\Reports;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StatisticCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return StatisticUserResource::collection($this->collection);
    }
}
