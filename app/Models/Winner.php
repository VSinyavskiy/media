<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    const FIRST_TYPE  = 1;
    const SECOND_TYPE = 2;
    const THIRD_TYPE  = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'prize_type',
    ];

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
            self::FIRST_TYPE  => 'Первый подарок', //__('') 
            self::SECOND_TYPE => 'Второй подарок', //__('')
            self::THIRD_TYPE  => 'Третий подарок', //__('')
        ];
    }
}
