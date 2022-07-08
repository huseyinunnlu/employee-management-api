<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionTitle extends Model
{
    use HasFactory;
    protected $table = 'position_titles';
    protected $fillable = [
        'position_id',
        'lang_code',
        'title',
    ];
}
