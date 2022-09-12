<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File_Sending extends Model
{
    use HasFactory;
    const STATUS = ['PENDING','RECEIVED'];

    const PENDING = self::STATUS[0];
    const RECEIVED = self::STATUS[1];

    protected $fillable = [
        'id','client_id','notary_id','file_id','status','national_id_photocopy'
    ];

    protected $casts = [
        'id' => 'string',
        'client_id' => 'string',
        'notary_id' => 'string',
        'file_id' => 'string'
    ];

    /**
     * Get the sender that owns the File_Sending
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * Get the receiver that owns the File_Sending
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Notary::class, 'notary_id', 'id');
    }

    /**
     * Get the file that owns the File_Sending
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
