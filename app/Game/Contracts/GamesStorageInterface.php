<?php


namespace App\Game\Contracts;


/**
 * Interface GamesStorageInterface
 * @package App\Game\Contracts
 */
interface GamesStorageInterface
{
    /**
     * @param int $userId
     * @param int $score
     * @param array $gameData
     * @return GameResultInterface|null
     */
    public static function saveGameResult(int $userId, int $score, array $gameData): ?GameResultInterface;

    /**
     * @param \DateTime $date
     * @param int $count
     * @param int|null $withResultId
     * @return array|GameResultInterface[]
     */
    public static function getTopResults(\DateTime $date, int $count, ?int $withResultId = null): array;

    /**
     * @param int $userId
     * @return int
     */
    public static function getUserPlayedGamesCount(int $userId): int;

    /**
     * @param \DateTime $date
     * @param int $userId
     * @return GameResultInterface|null
     */
    public static function getUserBestResult(\DateTime $date, int $userId): ?GameResultInterface;
}