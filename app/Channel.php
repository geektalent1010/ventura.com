<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'user_id',
        'receive_user_id',
        'channel_unique_name',
        'last_read_message_sid',
        'last_message_readed_at',
        'is_connected'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function otherUser() {
        return $this->belongsTo('App\User', 'receive_user_id', 'id');
    }
}
