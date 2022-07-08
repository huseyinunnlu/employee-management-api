<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Models\GlobalFunctions;

class Role extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'roles';
    protected $fillable = [];

    public function titles()
    {
        return $this->hasMany(RoleTitle::class, 'role_id');
    }
}
