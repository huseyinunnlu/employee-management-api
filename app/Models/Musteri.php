<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musteri extends Model
{
    use HasFactory;
    protected $table = 'musteris';
    protected $fillable = [
        'title', 'address', 'zipcode', 'phone', 'fax', 'email', 'tax', 'tax_no', 'website', 'workplace_registration_number', 'registration_no', 'iban'
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'musteri_id', 'id');
    }

    public function employeer_branches()
    {
        return $this->hasMany(EmployeerBranch::class, 'musteri_id', 'id');
    }
}
