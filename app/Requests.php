<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'user_id',
        'requester',
        'context',
        'is_active'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function request_user() {
        return $this->belongsTo('App\User', 'requester', 'id');
    }
}
