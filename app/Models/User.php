<?php

namespace App\Models;

use App\Http\Traits\Models\User\Attributes;
use App\Http\Traits\Models\User\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;


class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        Sluggable,
        Attributes,
        Relations;


    protected $appends = ['age', 'age_range', 'formatted_start_date'];

    protected $with = ['city', 'role', 'tax_class', 'nation'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['first_name', 'last_name', 'id'],
                'onUpdate' => true,
            ],
        ];
    }

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeGetUsersByDocument($query, $is_have, $request)
    {
        $query->where(function ($query) use ($is_have, $request) {
            if ($is_have == true) {
                return $query->whereHas('document', function ($query) use ($request) {
                    $query->when($request->type_id, function ($query) use ($request) {
                        $query->where('type_id', $request->type_id);
                    });
                });
            }
            return $query->whereDoesntHave('document', function ($query) use ($request) {
                $query->when($request->type_id, function ($query) use ($request) {
                    $query->where('type_id', $request->type_id);
                });
            });
        });
    }
}
