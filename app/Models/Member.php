<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
        'is_banned',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
