<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name', 'last_name', 'birthday',
        'gender', 'phone',
        'company_name', 'site_url', 'vat_number',
        'main_avatar_url', 'other_avatar_url1', 'other_avatar_url2', 'other_avatar_url3', 'other_avatar_url4',
        'other_avatar_url5', 'other_avatar_url6', 'other_avatar_url7', 'other_avatar_url8', 'banner_img_url',
        'logo_url',
        'city', 'state', 'country', 'street', 'house_number', 'postal_code',
        'job_title',
        'main_interests', 'other_interests', 'story_content',
        'followers',
        'trash_buddies',
        'interest_based',
        'display_options',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getCity()
    {
        if (City::find($this->city)) {
            return City::find($this->city)->name;
        }

        return $this->city;

    }

    public function getState()
    {
        if (State::find($this->state)) {
            return State::find($this->state)->name;
        }

        return $this->state;

    }

    public function getCountry()
    {
        if (Country::find($this->country)) {
            return Country::find($this->country)->name;
        }

        return $this->country;

    }
}
