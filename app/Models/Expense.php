<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $fillable = ['user_id', 'status', 'notes'];

    const status_colors = [
        'accepted' => 'primary',
        'pending' => 'warning',
        'rejected' => 'danger'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function lines()
    {
        return $this->hasMany(ExpenseLine::class, 'expense_id', 'id');
    }
}
