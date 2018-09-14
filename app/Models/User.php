<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPasswordNotification;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    const ROLE_USER  = 1;
    const ROLE_ADMIN = 2;

    const DEFAULT_AVATAR_PATH = 'assets/images/default_avatar.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'city', 'email', 'is_mail_confirmed',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function($model) {
            $model->addMedia(resource_path(self::DEFAULT_AVATAR_PATH))
                     ->preservingOriginal()
                     ->toMediaCollection('avatar');
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function socials()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value ? bcrypt($value) : $this->password;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('frontend')
            ->setManipulations((new Manipulations())->fit(Manipulations::FIT_CROP, 160, 160))
            ->performOnCollections('avatar')
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

    public function getAvatarAttribute()
    {
        return $this->getFirstMedia('avatar') ?? false;
    }
}
