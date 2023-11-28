<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'user_id',
        'connected_user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function connectedUser()
    {
        return $this->belongsTo('App\Models\User', 'connected_user_id', 'id');
    }
}
