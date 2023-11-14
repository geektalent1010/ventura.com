<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedRank extends Model
{
    protected $fillable = [
        'user_id',
        'rank_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function rank() {
        return $this->belongsTo('App\Rank');
    }
}
