<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File_Access_Request extends Model
{
    use HasFactory;

    const STATUS = [
        'APPROVED', 'PENDING', 'REJECTED'
    ];

    const APPROVED = self::STATUS[0];
    const PENDING = self::STATUS[1];
    const REJECTED = self::STATUS[2];

    protected $fillable = [
        'id', 'file_id','requested_by','telephone','reason','status','has_been_viewed','notary','access_code'
    ];

    protected $casts = [
        'id' => 'string',
        'file_id' => 'string',
        'has_been_viewed' => 'boolean'
    ];

    /**
     * Get the file that owns the File_Access_Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
