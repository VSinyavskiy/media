<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Game\Contracts\ReceiveGamePointsInterface;

class UserPointsLog extends Model implements ReceiveGamePointsInterface
{
    const FRIEND_INVITE     = 1;
    const FIRST_TIME_GAMING = 2;
    const GAMING            = 3;

    const COUNT_FRIEND_INVITES_FOR_DATE = 10;
    const COUNT_POINT_FOR_FRIEND_INVITE = 1;

    const COUNT_WINNER_GAME_RANKS          = 3;
    const COUNT_POINT_FOR_WINNER_GAME_RANK = 5;

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'event_type', 'points', 'rank', 'scoring_at', 'invited_user_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'scoring_at',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function($model) {
            $model->user->updateTotalPoints();

            $model->checkTenthInvitedFriend();

            $model->checkGameRank();
        });
    }

    public function scopeSortByScoringAT($query)
    {
        $query->orderBy('scoring_at', 'DESC');
    }

    public function scopeFriendInviteEvent($query)
    {
        $query->where('event_type', self::FRIEND_INVITE);
    }

    public function scopeFirstTimeGamingEvent($query)
    {
        $query->where('event_type', self::FIRST_TIME_GAMING);
    }

    public function scopeGamingEvent($query)
    {
        $query->where('event_type', self::GAMING);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getEventNameAttribute()
    {
        return $this->getEventTypesList()[$this->event_type];
    }

    public function getEventTypesList()
    {
        return [
            self::FRIEND_INVITE     => __('app.pages.history.invite'),
            self::FIRST_TIME_GAMING => __('app.pages.history.first_time'),
            self::GAMING            => str_replace('%s', $this->rank, __('app.pages.history.top')),
        ];
    }

    public function checkTenthInvitedFriend()
    {
        if ($this->event_type != self::FRIEND_INVITE) {
            return false;
        }

        $countUserFriendInvites = self::where('user_id', $this->user_id)
                                        ->friendInviteEvent()
                                        ->count();

        if ($countUserFriendInvites === self::COUNT_FRIEND_INVITES_FOR_DATE) {
            $this->user->updateTenthFriendInvitedAT($this->scoring_at);
        }
    }

    public function checkGameRank()
    {
        if ($this->event_type != self::GAMING) {
            return false;
        }

        if ($this->rank <= self::COUNT_WINNER_GAME_RANKS) {
            $this->user->updateTotalPoints(self::COUNT_POINT_FOR_WINNER_GAME_RANK);
        }
    }

    public function receiveFriendInvitePoints($userId, $points, $invitedUserId)
    {
        $userPointsLog = new self([
            'user_id'         => $userId,
            'event_type'      => self::FRIEND_INVITE,
            'points'          => $points,
            'scoring_at'      => getNowTimestamp()->format('Y-m-d H:i:s'),
            'invited_user_id' => $invitedUserId,
        ]);

        return $userPointsLog->save();
    }

    public function receiveGameTopPoints(int $userId, int $points, int $rank, \DateTime $playedOn): bool
    {
        $userPointsLog = new self([
            'user_id'    => $userId,
            'event_type' => self::GAMING,
            'points'     => $points,
            'rank'       => $rank,
            'scoring_at' => getTimestampFromDateTime($playedOn)->format('Y-m-d H:i:s'),
        ]);

        return $userPointsLog->save();
    }

    public function receiveGameFirstPlayPoints(int $userId, int $points, \DateTime $playedOn): bool
    {
        $userPointsLog = new self([
            'user_id'    => $userId,
            'event_type' => self::FIRST_TIME_GAMING,
            'points'     => $points,
            'scoring_at' => getTimestampFromDateTime($playedOn)->format('Y-m-d H:i:s'),
        ]);

        return $userPointsLog->save();
    }
}
