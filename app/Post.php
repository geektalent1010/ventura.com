<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'description',
        'subject', 'content',
        'address',
        'event_date',
        'main_featured_image_url',
        'small_featured_image_url1',
        'small_featured_image_url2',
        'small_featured_image_url3',
        'small_featured_image_url4',
        'followers',
        'type',
        'is_active',
        'created_by'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
