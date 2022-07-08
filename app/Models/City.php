<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = ['title', 'country_id'];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
