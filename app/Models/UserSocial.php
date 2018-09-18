<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    protected $fillable = [
        'user_id', 'social_type', 'social_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFacebook($query)
    {
        $query->where('social_type', 'facebook');
    }

    public function scopeVkontakte($query)
    {
        $query->where('social_type', 'vkontakte');
    }

    public function getSocialProfileAttribute()
    {
        return !is_null($this->social_id) ? self::getSocialLink($this->social_type, $this->social_id) : __('admin.non_social');
    }

    public static function getSocialLink($socialType, $socialId)
    {
        switch($socialType) {
            case 'facebook':
                return 'http://fb.com/' . $socialId;
            case 'vkontakte':
                return 'http://vk.com/id' . $socialId;
            default:
                return null;
        }
    }
}
