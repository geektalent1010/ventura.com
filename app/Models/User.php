<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'sponsor_id',
        'username', 'email', 'password',
        'is_admin', 'user_type', 'status',
        'channel',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function channels()
    {
        return $this->hasMany('App\Models\Channel');
    }

    public function isAdmin()
    {
        if ($this->is_admin == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isIndividual()
    {
        if ($this->user_type == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isCompany()
    {
        if ($this->user_type == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isCoach()
    {
        if ($this->user_type == 2) {
            return true;
        } else {
            return false;
        }
    }

    public function getMono(): string
    {
        if ($this->user_type == 1) {
            return isset($this->profile->company_name) ? substr($this->profile->company_name, 0, 1) : 'C';
        } else {
            return substr($this->profile->first_name, 0, 1);
        }
    }

    public function getFullname()
    {
        if ($this->user_type == 1) {
            return $this->profile->company_name ?? 'Company Name'.$this->id;
        } else {
            return $this->profile->first_name.' '.$this->profile->last_name;
        }
    }

    public function posts(): HasMany
    {
        return $this->hasMany('App\Models\Post');
    }

    public function teams(): HasMany
    {
        return $this->hasMany('App\Models\Team');
    }

    public function teamMembers()
    {
        return $this->hasMany('App\Models\Member');
    }

    public function referrers()
    {
        return $this->hasMany('App\Models\User', 'sponsor_id');
    }

    public function referrersForChannel1()
    {
        return $this->referrers->filter(function ($child) {
            /** @var User $child */
            return $child->channel == 1;
        });
    }

    public function referrersForChannel2()
    {
        return $this->referrers->filter(function ($child) {
            /** @var User $child */
            return $child->channel == 2;
        });
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

    public function getSponsor()
    {
        if ($sponser = User::find($this->sponsor_id)) {
            return $sponser->username;
        } else {
            return '-';
        }
    }

    public function rank(): HasOne
    {
        return $this->hasOne('App\Models\RankUser');
    }

    public function advancedRank(): HasOne
    {
        return $this->hasOne('App\Models\AdvancedRank');
    }

    public function rankHistory(): HasMany
    {
        return $this->hasMany('App\Models\RankAchievementHistory');
    }

    public function getReferrals($referralUsers)
    {
        foreach ($referralUsers as $subreferral) {
            $subreferral->children = $subreferral->referrers;

            if ($subreferral->children->isNotEmpty()) {
                self::getReferrals($subreferral->children);
            }
        }

        return $referralUsers;
    }

    public function fetchReferrals($getAllReferrals, $getrefs = [])
    {
        foreach ($getAllReferrals as $referralUser) {
            $getrefs[] = $referralUser;
            if ($referralUser->children->isNotEmpty()) {
                $getrefs = self::fetchReferrals($referralUser->children, $getrefs);
            }
        }

        return $getrefs;
    }
}
