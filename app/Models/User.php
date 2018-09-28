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

use Cookie;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    const ROLE_USER  = 1;
    const ROLE_ADMIN = 2;

    const DEFAULT_AVATAR_PATH = 'assets/images/default_user_avatar.jpg';

    const DEFAULT_PASSWORD_LENGTH = 8;

    const FIRST_AFTER_INVITE_COOCKIE_LIVE_MINUTES = 2;

    const COUNT_TOP        = 5;
    const COUNT_HISTORY    = 5;
    const COUNT_TOP_GAMERS = 3;

    const GAME_ACTION_END_TIMESTAMP = '30.10.2018 23:59:59';

    private $position;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'city', 'email', 'is_mail_confirmed', 'total_points', '10th_friend_invited_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'mail_token', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', '10th_friend_invited_at',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function($model) {
            $model->addMedia(resource_path(self::DEFAULT_AVATAR_PATH))
                     ->preservingOriginal()
                     ->toMediaCollection('avatar');

            // $model->sendRegisterNotification();
        });
    }

    public function scopeUsers($query)
    {
        $query->where('role', self::ROLE_USER);
    }

    public function scopeWhileGameAction($query)
    {
        $query->where('updated_at', '<=', getTimestampFromDateTime(self::GAME_ACTION_END_TIMESTAMP));
    }

    public function scopeConfirmed($query)
    {
        $query->where('is_mail_confirmed', true);
    }

    public function scopeSortByTopTotalPoints($query)
    {
        $query->orderBy('total_points', 'DESC');
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

    public function points()
    {
        return $this->hasMany(UserPointsLog::class);
    }

    public function presents()
    {
        return $this->hasMany(Present::class);
    }

    public function getInvitedCountAttribute()
    {
        return $this->points()->friendInviteEvent()->count();
    }

    public function getIsWinnerAttribute()
    {
        return $this->presents()->count() ? true : false;
    }

    public function getSortedPointsDescAttribute()
    {
        return $this->points()->sortByScoringAT()->get();
    }

    public function getPositionAttribute()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        return $this->position = $position;
    }

    public function getMaskedPhoneAttribute()
    {
        return substr($this->attributes['phone'], 0, 2) . ' ' . 
               substr($this->attributes['phone'], 2, 4) . ' ' . 
               substr($this->attributes['phone'], 6, 2) . ' ' . 
               substr($this->attributes['phone'], 8, 2) . ' ' . 
               substr($this->attributes['phone'], 10, 2);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = withoutSpace($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value ? bcrypt($value) : $this->password;
    }

    public function setMailTokenAttribute($value)
    {
        $this->attributes['mail_token'] = ! is_null($value) ? md5($value . microtime()) : $value;
    }

    public function updateTotalPoints()
    {
        $this->update([
            'total_points' => $this->points()->sum('points')
        ]);
    }

    public function updateTenthFriendInvitedAT($dateTime)
    {
        $this->update([
            '10th_friend_invited_at' => getTimestampFromDateTime($dateTime)->format('Y-m-d H:i:s')
        ]);
    }

    public function updateConfirmed($confirmedStatus)
    {
        $this->update([
            'is_mail_confirmed' => $confirmedStatus
        ]);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('frontend')
            ->setManipulations((new Manipulations())->fit(Manipulations::FIT_CROP, 160, 160))
            ->performOnCollections('avatar')
            ->format(Manipulations::FORMAT_JPG)
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

    public function calculatePosition()
    {
        $userId   = $this->id;

        $users    = self::users()->confirmed()->whileGameAction()->sortByTopTotalPoints()->get();
        $position = $users->search(function ($user, $key) use ($userId) {
            return $user->id == $userId;
        });

        return $position + 1; //since it will be a zero-indexed collection
    }

    public static function generatePassword()
    {
        return str_random(self::DEFAULT_PASSWORD_LENGTH);
    }

    public static function checkIsInvite()
    {
        $userId = Cookie::get('invited');

        if (isset($userId)) {
            $userPointsLog = new UserPointsLog();

            return $userPointsLog->receiveFriendInvitePoints($userId, UserPointsLog::COUNT_POINT_FOR_FRIEND_INVITE);
        }
    }
}
