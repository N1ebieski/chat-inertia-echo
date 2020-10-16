<?php

namespace App\Models;

use App\Models\Traits\Carbonable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory, Carbonable;

    /**
     * Undocumented variable
     *
     * @var array
     */
    public $fillable = [
        'content'
    ];

    // Relations

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
