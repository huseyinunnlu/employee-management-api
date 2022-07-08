<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTypeTitle extends Model
{
    use HasFactory;
    protected $table = 'document_type_titles';
    protected $fillable = [
        'type_id',
        'lang_code',
        'title'
    ];
}
