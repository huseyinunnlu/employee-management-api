<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Models\GlobalFunctions;

class DocumentType extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'document_types';
    protected $fillable = [];

    public function titles()
    {
        return $this->hasMany(DocumentTypeTitle::class, 'type_id');
    }
}
