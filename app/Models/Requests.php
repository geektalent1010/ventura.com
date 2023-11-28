<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requests extends Model
{
    protected $fillable = [
        'user_id',
        'requester',
        'context',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function requestUser(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'requester', 'id');
    }
}
