<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\File;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','user_id','national_id'
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
     * Get all of the sentFiles for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentFiles(): HasMany
    {
        return $this->hasMany(File_Sending::class, 'client_id', 'id');
    }
}
