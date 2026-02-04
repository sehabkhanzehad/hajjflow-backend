<?php

namespace App\Models;

use App\Enums\CustomerRole;
use App\Models\Traits\HasAvatar;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasAvatar;
    use HasApiTokens;

    public $type = 'customer';

    protected $casts = [
        'role'              => CustomerRole::class,
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function agency(): HasOne
    {
        return $this->hasOne(Agency::class);
    }
}
