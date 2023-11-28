<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'user_id',
        'receive_user_id',
        'channel_unique_name',
        'last_read_message_sid',
        'last_message_readed_at',
        'is_connected',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function otherUser()
    {
        return $this->belongsTo('App\Models\User', 'receive_user_id', 'id');
    }
}
