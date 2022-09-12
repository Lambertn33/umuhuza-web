<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory;
    const TYPE = [
        'NOTARY_UPLOAD','CLIENT_UPLOAD'
    ];

    const NOTARY_UPLOAD = self::TYPE[0];
    const CLIENT_UPLOAD = self::TYPE[1];

    protected $fillable = [
        'id','filename','owner','file_path','file_type','file_number'
    ];

    protected $casts = [
        'id' => 'string',
        'owner' => 'string',
    ];

    /**
     * Get the confirmation associated with the File
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function confirmation(): HasOne
    {
        return $this->hasOne(File_Confirmation::class, 'file_id', 'id');
    }

    /**
     * Get the sending associated with the File
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sending(): HasOne
    {
        return $this->hasOne(File_Sending::class, 'file_id', 'id');
    }

    /**
     * Get all of the access_requests for the File
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function access_requests(): HasMany
    {
        return $this->hasMany(File_Access_Request::class, 'file_id', 'id');
    }
}
