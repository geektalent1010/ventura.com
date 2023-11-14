<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'last_read_request_id',
        'last_read_news_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
