<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseLine extends Model
{
    use HasFactory;
    protected $table = 'expense_lines';
    protected $fillable = [
        'expense_id', 'type_id', 'date', 'file', 'desc', 'price'
    ];

    public function type()
    {
        return $this->hasOne(ExpenseType::class, 'id', 'type_id');
    }
}
