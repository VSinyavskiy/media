<?php


namespace App\Game\Contracts;


/**
 * Interface GameResultInterface
 * @package App\Game\Contracts
 */
interface GameResultInterface
{
    /**
     * @return int
     */
    public function getResultId(): int;

    /**
     * @return int
     */
    public function getPlayerId(): int;

    /**
     * @return string
     */
    public function getPlayerName(): string;

    /**
     * @return int
     */
    public function getPlayerScore(): int;

    /**
     * @return int
     */
    public function getPlayerRank(): int;

    /**
     * @return \DateTime
     */
    public function getPlayedOn(): \DateTime;
}