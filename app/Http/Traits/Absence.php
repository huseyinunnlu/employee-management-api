<?php

namespace App\Http\Traits;

use App\Exceptions\HttpQueryException;
use App\Models\Absence as ModelsAbsence;
use Carbon\Carbon;

trait Absence
{
    public function checkValidDateRange($date, $time)
    {
        $start_date = Carbon::parse($date[0])->format('Y-m-d');
        $end_date = Carbon::parse($date[1])->format('Y-m-d');
        $start_time = $time[0] ? Carbon::parse($time[0])->format('H:i') : null;
        $end_time = $time[1] ? Carbon::parse($time[1])->format('H:i') : null;

        if ($end_date < $start_date) {
            throw new HttpQueryException(trans('messages.not_end_date_bigger'));
        }

        if ($start_time && $end_time && $end_time < $start_time) {
            throw new HttpQueryException(trans('messages.not_end_time_bigger'));
        }

        return [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time ?? null,
            'end_time' => $end_time ?? null,
        ];
    }

    public function calculateDays($date)
    {

        $start_date = Carbon::parse($date->start_date);
        $end_date = Carbon::parse($date->end_date);

        $day_count = 0;
        if ($date->day_type == 'full') {
            $day_count = $start_date->diffInDays(Carbon::parse($end_date)) + 1;
        } else {
            $day_count = 0.5;
        }

        return $day_count;
    }

    public function getDays($user_id)
    {
        $holidays = ModelsAbsence::where('user_id', $user_id)
            ->with('type')
            ->where(function ($query) {
                $query->where('start_date', '>=', date('Y-01-01'));
                $query->where('status', '!=', 'rejected');
            })
            ->orderBy('start_date', 'desc')
            ->get();
        $sum_days = 0;
        foreach ($holidays as $holiday) {
            $sum_days += $this->calculateDays($holiday);
        }

        return [$sum_days, $holidays];
    }

    public function calculateUserDeservedDays($user)
    {
        $deserved = 0;
        $start_date = Carbon::parse($user->start_date);
        $now = Carbon::now();
        if ($start_date->addYear() <= $now) {
            $days = $this->getDays($user->id);
            $days = [
                'sum_days' => $days[0],
                'days' => $days[1],
            ];
            $deserved = 20;
        } else {
            $days = [
                'sum_days' => 0,
                'days' => []
            ];
        }

        return [$deserved, $days];
    }

    public function dedectConflictingDates($dates, $user_id)
    {

        $start_date = date($dates['start_date']);
        $end_date = date($dates['end_date']);


        $dates = ModelsAbsence::where('user_id', $user_id)
            ->where('status', '!=', 'rejected')
            // ->whereRaw(($start_date . 'BETWEEN start_date AND end_date') and ($end_date . 'BETWEEN start_date AND end_date'))
            ->get();

        if ($dates) {
            return $dates;
        }
    }
}
