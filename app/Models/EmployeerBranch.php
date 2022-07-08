<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeerBranch extends Model
{
    use HasFactory;
    protected $table = 'employeer_branches';
    protected $fillable = [
        'musteri_id', 'employeer_title', 'tax', 'tax_no', 'website', 'workplace_registration_number', 'commercial_registration_number', 'address'
    ];
}
