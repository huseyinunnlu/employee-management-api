<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignLanguage extends Model
{
    use HasFactory;
    protected $table = 'foreign_languages';
    protected $fillable = ['user_id', 'language_id', 'status'];

    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
}
