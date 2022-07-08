<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceTypeTitle extends Model
{
    use HasFactory;
    protected $table = 'absence_type_titles';
    protected $fillable = ['title', 'lang_code', 'type_id'];
}
