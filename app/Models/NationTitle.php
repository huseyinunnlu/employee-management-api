<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationTitle extends Model
{
    use HasFactory;
    protected $table = 'nation_titles';
    protected $fillable = ['title', 'nation_id', 'lang_code'];
}
