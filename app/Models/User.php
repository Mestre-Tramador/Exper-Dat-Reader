<?php

#region License
/**
 * Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
 *  Copyright (C) 2023  Mestre-Tramador
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
#endregion

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * The Users access and manage the files on the system.
 *
 * @author Mestre-Tramador
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable;
    use Authorizable;
    use HasFactory;
    use SoftDeletes;

    /**
     * @inheritDoc
     * @ignore Must not be typed.
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @inheritDoc
     * @ignore Must not be typed.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * @inheritDoc
     * @ignore Must not be typed.
     */
    protected $hidden = ['password'];

    /** @inheritDoc */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /** @inheritDoc */
    public function getJWTCustomClaims(): array
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

    /** @inheritDoc */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'creation' => $this->created_at->format('Y-m-d h:i:s')
        ];
    }
}
