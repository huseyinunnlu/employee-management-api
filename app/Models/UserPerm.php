<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPerm extends Model
{
    use HasFactory;
    protected $table = 'user_perms';
    protected $fillable = [
        'user_id', 'company_id', 'department_id', 'work_place_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
