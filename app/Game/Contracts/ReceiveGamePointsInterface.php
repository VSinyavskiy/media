<?php


namespace App\Game\Contracts;


/**
 * Interface ReceiveGamePointsInterface
 * @package App\Game\Contracts
 */
interface ReceiveGamePointsInterface
{
    /**
     * Receive bonus points from the game (TOP players of the day)
     *
     * @param int $userId
     * @param int $points
     * @param int $rank
     * @param \DateTime $playedOn
     * @return bool
     */
    public function receiveGameTopPoints(int $userId, int $points, int $rank, \DateTime $playedOn): bool;

    /**
     * Receive bonus points from the game (user's first play)
     *
     * @param int $userId
     * @param int $points
     * @param \DateTime $playedOn
     * @return bool
     */
    public function receiveGameFirstPlayPoints(int $userId, int $points, \DateTime $playedOn): bool;
}