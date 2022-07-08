<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationInfo extends Model
{
    use HasFactory;
    protected $table = 'education_infos';
    protected $fillable = [
        'user_id',
        'status',
        'url',
        'title',
        'graduated_school',
        'certificate_grade',
        'department',
        'start_year',
        'finish_year'
    ];
}
