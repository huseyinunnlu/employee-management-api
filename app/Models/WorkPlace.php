<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlace extends Model
{
    use HasFactory;
    protected $table = 'work_places';

    protected $fillable = [
        'department_id', 'city_id', 'title', 'email', 'morning_start_time', 'morning_end_time', 'morning_break', 'afternoon_start_time', 'afternoon_end_time', 'afternoon_break', 'night_start_time', 'night_end_time', 'night_break', 'full_start_time', 'full_end_time', 'full_break', 'report_start_time', 'report_end_time', 'report_break', 'permit_start_time', 'permit_end_time', 'permit_break', 'annual_permit_start_time', 'annual_permit_end_time', 'annual_permit_break'
    ];

    public function department()
    {
        return $this->hasOne(Department::class,  'id', 'department_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
