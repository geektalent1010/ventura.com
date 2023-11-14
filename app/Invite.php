<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'user_id',
        'requester',
        'member_id',
        'is_active',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function request_user() {
        return $this->belongsTo('App\User', 'requester', 'id');
    }

    public function invite_member() {
        return $this->belongsTo('App\Member', 'member_id', 'id');
    }
}
