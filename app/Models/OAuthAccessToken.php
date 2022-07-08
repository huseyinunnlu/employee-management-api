<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OAuthAccessToken extends Model
{
    use HasFactory;
    protected $table = 'oauth_access_tokens';

}
