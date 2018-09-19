<?php


namespace App\Game;


use App\Game\Contracts\ReceiveGamePointsInterface;

class GamePointsReceiverStub implements ReceiveGamePointsInterface
{

    /**
     * Receive bonus points from the game (TOP players of the day)
     *
     * @param int $userId
     * @param int $points
     * @param int $rank
     * @param \DateTime $playedOn
     * @return bool
     * @throws \Exception
     */
    public function receiveGameTopPoints(int $userId, int $points, int $rank, \DateTime $playedOn): bool
    {
        echo sprintf("STUB    | I'm trying to receive %s points for user with ID: %s, whose rank in the TOP was %s. User played on: %s\n",
            $points, $userId, $rank, $playedOn->format('d.m.Y H:i:s'));
        return (bool)random_int(0, 1);
    }

    /**
     * Receive bonus points from the game (user's first play)
     *
     * @param int $userId
     * @param int $points
     * @param \DateTime $playedOn
     * @return bool
     * @throws \Exception
     */
    public function receiveGameFirstPlayPoints(int $userId, int $points, \DateTime $playedOn): bool
    {
        return (bool)random_int(0, 1);
    }
}