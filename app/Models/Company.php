<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = ['logo', 'musteri_id', 'title', 'email', 'address', 'city_id'];

    public function departments()
    {
        return $this->hasMany(Department::class, 'company_id', 'id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'company_id', 'id');
    }

    public function musteri()
    {
        return $this->hasOne(Musteri::class, 'id', 'musteri_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function perms()
    {
        return $this->belongsToMany(User::class, 'user_perms', 'company_id');
    }
}
