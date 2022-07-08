<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Http\Traits\Models\GlobalFunctions;

class Position extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'positions';
    protected $fillable = ['department_id'];

    public function titles()
    {
        return $this->hasMany(PositionTitle::class, 'position_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
