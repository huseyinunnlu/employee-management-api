<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryTitle extends Model
{
    use HasFactory;
    protected $table = "country_titles";
    protected $fillable = ["country_id", "lang_code", "title"];
}
