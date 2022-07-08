<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ApiSelectDataResource;
use App\Http\Resources\EducationInfoResource;
use App\Http\Resources\Profile\CertificateResource;
use App\Http\Resources\Profile\ForeignLanguageResource;
use App\Http\Resources\Profile\ReferenceResource;
use App\Http\Resources\Profile\WorkExperienceResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $manager = $this->whenLoaded('manager');
        $country = $this->whenLoaded('country');
        $nation = $this->whenLoaded('nation');
        $city = $this->whenLoaded('city');
        $born_place = $this->whenLoaded('born_place');
        $education_info = $this->whenLoaded('education_info');
        $last_education = $education_info[count($education_info) - 1] ?? null;
        $driver_licences = [];
        foreach (config('enums.licences') as $licence) {
            $this['licence_' . $licence] ? array_push($driver_licences, $licence) : '';
        }

        $days = ['mon', 'tur', 'wed', 'thu', 'fri', 'sat', 'sun'];
        $work_days = [];
        foreach ($days as $day) {
            $this[$day] ? array_push($work_days, $day) : '';
        }

        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "company_id" => $this->company_id,
            "card" => [
                "photo" => env('ASSET_URL') . $this->photo,
                "full_name" => $this->first_name . ' ' . $this->last_name,
                "role" => new ApiSelectDataResource($this->whenLoaded('role')),
                "start_date" => [
                    "date" => format_date($this->start_date, config('app.date_format')),
                    "formatted" => Carbon::parse($this->start_date)->diffForHumans(),
                ],
                "work_type" => $this->work_type,
                "insurance_status" => $this->insurance_status,
                "company" => $this->whenLoaded('company')->title ?? null,
                "department" => $this->whenLoaded('department')->title ?? null,
                "position" => new ApiSelectDataResource($this->whenLoaded('position')),
                "work_place" => $this->whenLoaded('work_place')->title ?? null,
                "manager" => $manager ? $manager->first_name . ' ' . $manager->last_name : null,
            ],
            "personal_information" => [
                "id_number" => $this->id_number,
                "id_serie_number" => $this->id_serie_number,
                "registration_number" => $this->registration_number,
                "insurance_no" => $this->insurance_no,
                "born_place" => $born_place ? $born_place->country->current_title . '/' . $born_place->title : null,
                "birthday" => format_date($this->birthday, config('app.date_format')),
                "mariance_status" => $this->mariance_status,
                "licences" => $driver_licences,
                "military_status" => $this->military_status,
            ],
            "contact_info" => [
                "email" => $this->email,
                "home_phone" => $this->home_phone,
                "personal_phone" => $this->personal_phone,
                "work_phone" => $this->work_phone,
                "whatsapp_phone" => $this->whatsapp_phone,
                "address" => $this->address,
            ],
            "education_status" => $last_education,
            'form' => [
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "country_id" => $born_place->country->id ?? null,
                "born_place_id" => $born_place->id ?? null,
                "birthday" => format_date($this->birthday, config('app.date_format')),
                "gender" => $this->gender,
                "nation_id" => $nation->id ?? null,
                "licences" => $driver_licences,
                "work_status" => $this->work_status,
                "work_days" => $work_days,
                "licence_date" => format_date($this->lisence_date, config('app.date_format')),
                "military_status" => $this->military_status,
                "iban" => $this->iban,
                "id_number" => $this->id_number,
                "id_serie_number" => $this->id_serie_number,
                "blood_grup" => $this->blood_group,
                "mariance_status" => $this->mariance_status,
                "is_smoking" => $this->is_smoking == 1 ? true : false,
                "father_name" => $this->father_name,
                "mother_name" => $this->mother_name,
                "important_or_surgeon" => $this->important_or_surgeon,
                "address" => $this->adress,
                "address_country_id" => $city->country->id ?? null,
                "city_id" => $city->id ?? null,
                "home_phone" => $this->home_phone,
                "personal_phone" => $this->personal_phone,
                "work_phone" => $this->work_phone,
                "whatsapp_phone" => $this->whatsapp_phone,
                "pdks_id" => $this->pdks_id,
                "exempt_rate" => $this->exempt_rate,
                "tgb_start_date" => format_date($this->tgb_start_date, config('app.date_format')),
            ],
            "emergency_contact" => $this->whenLoaded('emergency_contact') ?? [],
            "education_info" => EducationInfoResource::collection($education_info) ?? [],
            "certificate" => CertificateResource::collection($this->whenLoaded('certificate')) ?? [],
            "foreign_language" => ForeignLanguageResource::collection($this->whenLoaded('foreign_language')) ?? [],
            "work_experience" => WorkExperienceResource::collection($this->whenLoaded('work_experience')) ?? [],
            "reference" => ReferenceResource::collection($this->whenLoaded('reference')) ?? [],
        ];
    }
}
