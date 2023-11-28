<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'user_id',
        'requester',
        'member_id',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function requestUser()
    {
        return $this->belongsTo('App\Models\User', 'requester', 'id');
    }

    public function inviteMember()
    {
        return $this->belongsTo('App\Models\Member', 'member_id', 'id');
    }
}
