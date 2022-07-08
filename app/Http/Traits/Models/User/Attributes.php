<?php

namespace App\Http\Traits\Models\User;

use Carbon\Carbon;

trait Attributes
{
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->age;
    }

    public function getAgeRangeAttribute()
    {
        $ageRange = [
            '0-18' => [0, 18],
            '18-25' => [18, 25],
            '25-30' => [25, 30],
            '30-40' => [30, 40],
            '40-50' => [40, 50],
            '50-65' => [50, 65],
            '65+' => [65, 300],
        ];

        foreach ($ageRange as $key => [$start_age, $end_age]) {
            if (in_array($this->age, range($start_age, $end_age))) {
                return $key;
            }
        }
    }

    public function getFormattedStartDateAttribute()
    {
        $date = Carbon::parse($this->start_date)->longAbsoluteDiffForHumans();
        if (!strpos($date, 'yıl') || strpos($date, 'year')) {
            return trans('messages.lessAyear');
        }

        return $date;
    }


    public function getDepartmentTitleAttribute()
    {
        $department_id = $this->department_id ?? null;
        if (!$department_id) {
            return trans('messages.no_department');
        }

        return $this->department->title;
    }

    public function getMilitaryStatusTitleAttribute()
    {
        if ($this->military_status) {
            return trans('messages.' . $this->military_status);
        }

        return trans('messages.undefined');
    }

    public function getGenderTitleAttribute()
    {
        return trans('messages.' . $this->gender);
    }

    public function getMarianceStatusTitleAttribute()
    {
        $mariance_statuses = [
            "1" => "messages.mariance_1",
            "2" => "messages.mariance_2",
            "3" => "messages.mariance_3",
            "4" => "messages.mariance_4",
            "5" => "messages.mariance_5",
            "6" => "messages.mariance_6",
            "7" => "messages.mariance_7",
            "8" => "messages.mariance_8",
            "9" => "messages.mariance_9",
            "10" => "messages.mariance_10",
            "11" => "messages.mariance_11",
            "12" => "messages.mariance_12",
            "13" => "messages.mariance_13",
            "14" => "messages.mariance_14",
            "15" => "messages.mariance_15",
        ];


        if ($this->mariance_status) {
            return trans($mariance_statuses[$this->mariance_status]);
        }

        return trans('messages.undefined');
    }
}
