<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxClassTitle extends Model
{
    use HasFactory;
    protected $table = 'tax_class_titles';
    protected $fillable = [
        'class_id',
        'lang_code',
        'title'
    ];
}
