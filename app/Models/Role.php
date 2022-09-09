<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    const TYPE = [
        'ADMINISTRATOR','CLIENT','NOTARY'
    ];
    
    const ADMINISTRATOR = self::TYPE[0];
    const CLIENT = self::TYPE[1];
    const NOTARY = self::TYPE[2];

    const REGISTER_TYPE = [
        self::CLIENT, self::NOTARY
    ];

    protected $fillable = ['id','type'];

    protected $casts = [
        'id' => 'string'
    ];

    /**
     * Get all of the users for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
