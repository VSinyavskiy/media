<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    const FIRST_TYPE  = 1;
    const SECOND_TYPE = 2;
    const THIRD_TYPE  = 3;

    const COUNT_WINNERS = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'prize_type',
    ];

    public function scopeSortByCreatedAT($query)
    {
        $query->orderBy('created_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPrizeNameAttribute()
    {
        return $this->getPrizeTypesList()[$this->prize_type];
    }

    public function getPrizeTypesList()
    {
        return [
            self::FIRST_TYPE  => __('app.presents.certificate_2000'),
            self::SECOND_TYPE => __('app.presents.certificate_10000'),
            self::THIRD_TYPE  => __('app.presents.certificate_20000'),
        ];
    }

    public function getPrizeImageAttribute()
    {
        return $this->getPrizeImagesList()[$this->prize_type];
    }

    public function getPrizeImagesList()
    {
        return [
            self::FIRST_TYPE  => asset('assets/img/prize-2000' . (\App::getLocale() == 'kz' ? '-kz' : '') . '.png'),
            self::SECOND_TYPE => asset('assets/img/gift-card' . (\App::getLocale() == 'kz' ? '-kz' : '') . '.png'),
            self::THIRD_TYPE  => asset('assets/img/prize-20000' . (\App::getLocale() == 'kz' ? '-kz' : '') . '.png'),
        ];
    }

    public static function issetWinners()
    {
        return self::count() ? true : false;
    }
}
