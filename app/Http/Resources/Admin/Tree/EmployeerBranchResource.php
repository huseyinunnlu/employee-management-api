<?php

namespace App\Http\Resources\Admin\Tree;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeerBranchResource extends JsonResource
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
            "musteri_id" => $this->musteri_id,
            "employeer_title" => $this->employeer_title,
            "tax" => $this->tax,
            "tax_no" => $this->tax_no,
            "website" => $this->website,
            "workplace_registration_number" => $this->workplace_registration_number,
            "commercial_registration_number" => $this->commercial_registration_number,
            "address" => $this->address,
        ];
    }
}
