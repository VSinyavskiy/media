<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPasswordNotification;
use App\Notifications\UserRegisterNotification;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    const ROLE_USER  = 1;
    const ROLE_ADMIN = 2;

    const DEFAULT_AVATAR_PATH = 'assets/images/default_avatar.png';

    const DEFAULT_PASSWORD_LENGTH = 8;

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
        'mail_token', 'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function($model) {
            $model->addMedia(resource_path(self::DEFAULT_AVATAR_PATH))
                     ->preservingOriginal()
                     ->toMediaCollection('avatar');

            $model->sendRegisterNotification();
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function sendRegisterNotification()
    {
        if (is_null($this->is_mail_confirmed) && is_null($this->role)) {
            $this->notify(new UserRegisterNotification());
        }
    }

    public function socials()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value ? bcrypt($value) : $this->password;
    }

    public function setMailTokenAttribute($value)
    {
        $this->attributes['mail_token'] = md5($value . microtime());
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

    public function setAvatarFromUrl($url)
    {
        $this->clearMediaCollection('avatar');
        return $this->addMediaFromUrl($url)
                        ->usingFileName('avatar.jpg')
                        ->toMediaCollection('avatar');
    }

    public function saveSocial($socialType, $socialId)
    {
        return UserSocial::firstOrCreate([
            'user_id'     => $this->id,
            'social_type' => $socialType,
            'social_id'   => $socialId,
        ]);
    }

    public static function generatePassword()
    {
        return str_random(self::DEFAULT_PASSWORD_LENGTH);
    }
}
