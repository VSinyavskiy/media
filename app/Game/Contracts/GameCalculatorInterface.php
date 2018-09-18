<?php


namespace App\Game\Contracts;


/**
 * Interface GameCalculatorInterface
 * @package App\Services
 */
interface GameCalculatorInterface
{
    /**
     * @param array $data
     */
    public function calculate(array $data): void;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @return array|string[]
     */
    public function getErrors(): array;

    /**
     * @return int
     */
    public function getScore(): int;

    /**
     * @return int
     */
    public function getSmallDonersCount(): int;

    /**
     * @return int
     */
    public function getMediumDonersCount(): int;

    /**
     * @return int
     */
    public function getBigDonersCount(): int;
}