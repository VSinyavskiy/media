<?php


namespace App\Game\Contracts;


/**
 * Interface ReceiveGamePointsInterface
 * @package App\Game\Contracts
 */
interface ReceiveGamePointsInterface
{
    /**
     * Receive bonus points from the game
     *
     * @param int $userId
     * @param int $points
     * @param int $rank
     * @param \DateTime $playedOn
     * @return bool
     */
    public function receiveGamePoints(int $userId, int $points, int $rank, \DateTime $playedOn): bool;
}