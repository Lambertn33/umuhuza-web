<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File_Confirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','file_id'
    ];

    protected $casts = [
        'id' => 'string',
        'file_id'=> 'string'
    ];

    /**
     * Get the file that owns the File_Confirmation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    /**
     * Get all of the confirmation_users for the File_Confirmation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confirmation_users(): HasMany
    {
        return $this->hasMany(File_Confirmation_User::class, 'file_confirmation_id', 'id');
    }
}
