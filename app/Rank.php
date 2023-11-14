<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = [
        'name',
        'level',
        'profit',
        'customers',
        'partners',
        'partner_group',
        'channel1', 'channel2',
        'is_active'
    ];
}
