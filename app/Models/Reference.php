<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $table = "references";
    protected $fillable = [
        'user_id', 'full_name', 'work_place_name', 'experience', 'phone'
    ];
}
