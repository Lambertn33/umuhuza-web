<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File_Confirmation_User extends Model
{
    use HasFactory;

    const STATUS = [
        'APPROVED','REJECTED','PENDING'
    ];

    const APPROVED = self::STATUS[0];
    const REJECTED = self::STATUS[1];
    const PENDING = self::STATUS[2];

    protected $fillable = [
        'id','file_confirmation_id','names','telephone','national_id','status','confirmation_code'
    ];

    protected $casts = [
        'id' => 'string',
        'file_confirmation_id'=> 'string'
    ];

        /**
     * Get the file that owns the File_User_Confirmation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function confirmation(): BelongsTo
    {
        return $this->belongsTo(File_Confirmation::class, 'file_confirmation_id', 'id');
    }
}
