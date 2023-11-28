<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankUser extends Model
{
    protected $fillable = [
        'user_id',
        'rank_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function rank()
    {
        return $this->belongsTo('App\Models\Rank');
    }
}
