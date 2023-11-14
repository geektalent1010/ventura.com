<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'user_id',
        'connected_user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function connected_user() {
        return $this->belongsTo('App\User', 'connected_user_id', 'id');
    }
}
