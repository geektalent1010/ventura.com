<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
        'is_banned',
    ];

    public function team() {
        return $this->belongsTo('App\Team');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
