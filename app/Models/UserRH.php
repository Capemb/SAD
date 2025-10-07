<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserRH extends Model
{
    use HasApiTokens;
    protected $table = 'user_rhs';

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];
}
