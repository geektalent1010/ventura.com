<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'user_id',
        'channel_unique_name',
        'team_logo',
        'name',
        'description',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function members() {
        return $this->hasMany('App\Member');
    }
}
