<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\HasMany;

use Laravel\Lumen\Auth\Authorizable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes;

    /** @inheritDoc */
    protected $fillable = ['name', 'email', 'password'];

    /** @inheritDoc */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /** @inheritDoc */
    protected $hidden = ['password'];

    /** @inheritDoc */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /** @inheritDoc */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Relate with the `.dat`s files,
     * holding all the uploaded ones.
     *
     * @return HasMany
     */
    public function dats(): HasMany
    {
        return $this->hasMany(Dat::class);
    }
}
