<?php

namespace App\Models;

use App\Game\Contracts\GameResultInterface;
use App\Game\Contracts\GamesStorageInterface;
use Illuminate\Database\Eloquent\Model;

class GameData extends Model implements GamesStorageInterface, GameResultInterface
{
    protected $hidden = [ 'game_log' ];
    protected $rank;

    /**
     * @param int $userId
     * @param int $score
     * @param array $gameData
     * @return GameResultInterface|null
     */
    public static function saveGameResult(int $userId, int $score, array $gameData): ?GameResultInterface
    {
        $model                  = new self;
        $model->user_id         = $userId;
        $model->score           = $score;
        $model->game_log        = json_encode($gameData);

        $isModelSaved           = $model->save();
        $isUserBestRecalculated = self::recalculateTodaysBestForUser($userId);

        if($isModelSaved && $isUserBestRecalculated) {
            return $model;
        }

        return null;
    }

    /**
     * @param \DateTime $date
     * @param int $count
     * @param int|null $withResultId
     * @return array|GameResultInterface[]
     */
    public static function getTopResults(\DateTime $date, int $count, ?int $withResultId = null): array
    {
        $models = self::whereDate('created_at', $date->format('Y-m-d'))
                        ->where('is_users_best_today', true)
                        ->orderBy('score', 'desc')->orderBy('created_at', 'asc')
                        ->take($count)->get();

        $models = $models->each(function($model, $key) {
            $model->setPlayerRank($key + 1);
        });

        if(!is_null($withResultId) && $models->contains('id', $withResultId) == false) {
            $models = $models->take($count - 1);
            $models->push(self::find($withResultId));
        }

        $array = [];
        foreach($models as $model) {
            $array[] = $model;
        }

        return $array;
    }

    protected static function recalculateTodaysBestForUser(int $userId): bool
    {
        // reset today user's best
        self::todayByUserId($userId)->where('is_users_best_today', true)
              ->update(['is_users_best_today' => false]);

        // set best
        $maxScore = self::todayByUserId($userId)
                        ->orderBy('score', 'desc')
                        ->orderBy('created_at', 'asc')
                        ->first();
        $maxScore->is_users_best_today = true;

        return $maxScore->save();
    }


    public function getPlayerId(): int
    {
        return $this->user->id;
    }

    public function getResultId(): int
    {
        return $this->id;
    }

    public function getPlayerName(): string
    {
        return trim($this->user->first_name . ' ' . $this->user->last_name);
    }

    public function getPlayerScore(): int
    {
        return $this->score;
    }

    public function getPlayedOn(): \DateTime
    {
        return $this->created_at;
    }

    public function getPlayerRank(): int
    {
        if (is_null($this->rank)) {
            $this->calculateRank();
        }

        return $this->rank;
    }

    public function setPlayerRank(int $rank)
    {
        return $this->rank = $rank;
    }

    protected function calculateRank()
    {
        $this->rank = self::whereDate('created_at', $this->created_at->format('Y-m-d'))
                            ->where('is_users_best_today', true)
                            ->where('score', '>=', $this->score)
                            ->where('created_at', '<=', $this->created_at)
                            ->count();
    }

    public function scopeTodayByUserId($query, $userId)
    {
        return $query->whereDate('created_at', date('Y-m-d'))
                     ->where('user_id', $userId);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param int $userId
     * @return int
     */
    public static function getUserPlayedGamesCount(int $userId): int
    {
        return self::where('user_id', $userId)->count();
    }

    /**
     * @param \DateTime $date
     * @param int $userId
     * @return GameResultInterface|null
     */
    public static function getUserBestResult(\DateTime $date, int $userId): ?GameResultInterface
    {
        return self::whereDate('created_at', $date->format('Y-m-d'))
                    ->where('user_id', $userId)
                    ->where('is_users_best_today', true)
                    ->first();
    }
}
