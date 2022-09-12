<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\File;
use Illuminate\Support\Facades\DB;

class Notary extends Model
{
    use HasFactory;

    const STATUS = [
        'APPROVED','REJECTED','PENDING'
    ];

    const APPROVED = self::STATUS[0];
    const REJECTED = self::STATUS[1];
    const PENDING = self::STATUS[2];

    protected $fillable = [
        'id','user_id','national_id_photocopy','notary_code','district','sector','cell','national_id','image','status'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];

    /**
     * Get the user that owns the Notary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function myFiles()
    {
        return File::where('owner',$this->id)->get();        
    }


    /**
     * Get all of the receivedFiles for the Notary
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedFiles(): HasMany
    {
        return $this->hasMany(File_Sending::class, 'notary_id', 'id');
    }
    
}
