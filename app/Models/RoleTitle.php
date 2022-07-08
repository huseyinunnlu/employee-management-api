<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTitle extends Model
{
    use HasFactory;
    protected $table = 'role_titles';
    protected $fillable = [
        'role_id',
        'lang_code',
        'title'
    ];
}
