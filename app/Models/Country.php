<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Http\Traits\Models\GlobalFunctions;

class Country extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'countries';
    protected $fillable = ['code'];

    public function titles()
    {
        return $this->hasMany(CountryTitle::class, 'country_id');
    }

    public function city()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}
