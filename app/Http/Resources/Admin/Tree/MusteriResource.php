<?php

namespace App\Http\Resources\Admin\Tree;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class MusteriResource extends JsonResource
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
            'title' => $this->title,
            'address' => $this->address,
            'zipcode' => $this->zipcode,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'email' => $this->email,
            'tax' => $this->tax,
            'tax_no' => $this->tax_no,
            'website' => $this->website,
            'workplace_registration_number' => $this->workplace_registration_number,
            'registration_no' => $this->registration_no,
            'iban' => $this->iban,
        ];
    }
}
