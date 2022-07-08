<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = ['company_id', 'city_id', 'title', 'mountly_holiday', 'daily_work_hour', 'overtime_rate', 'overtime_type', 'food_fee_tax', 'road_fee_tax'];
    public function work_places()
    {
        return $this->hasMany(WorkPlace::class, 'department_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function positions()
    {
        return $this->hasMany(Position::class, 'department_id', 'id');
    }
}
