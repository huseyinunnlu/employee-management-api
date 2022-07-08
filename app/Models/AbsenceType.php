<?php

namespace App\Models;

use App\Http\Traits\Models\GlobalFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceType extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'absence_types';
    protected $fillable = [];

    public function titles()
    {
        return $this->hasMany(AbsenceTypeTitle::class, 'type_id');
    }
}
