<?php


namespace App\Game;


use App\Game\Contracts\GameCalculatorInterface;

class GameCalculator implements GameCalculatorInterface
{
    const RECEIPT_SMALL  = 0;
    const RECEIPT_MEDIUM = 1;
    const RECEIPT_BIG    = 2;

    const GOOD_PRODUCT_POINTS = 1;
    const GOOD_PRODUCT_BONUS_POINTS = 3;
    const GOOD_PRODUCT_EXTRA_BONUS_POINTS = 7;

    const RECEIPT_MULTIPLIERS = [
        self::RECEIPT_SMALL  => 1.5,
        self::RECEIPT_MEDIUM => 2,
        self::RECEIPT_BIG    => 3,
    ];

    protected $score;
    protected $solvedReceipts;
    protected $errors;

    public function __construct()
    {
        $this->errors = ['Game data not calculated'];
    }

    /**
     * @param array $data
     */
    public function calculate(array $data): void
    {
        $this->clear();

        if(count($data) == 0) {
            $this->errors[] = 'Empty input data';
            return;
        }

        try {
            $this->processCalculation($data);
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    /**
     * @return array|string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return int
     */
    public function getSmallDonersCount(): int
    {
        return $this->solvedReceipts[self::RECEIPT_SMALL] ?? 0;
    }

    /**
     * @return int
     */
    public function getMediumDonersCount(): int
    {
        return $this->solvedReceipts[self::RECEIPT_MEDIUM] ?? 0;
    }

    /**
     * @return int
     */
    public function getBigDonersCount(): int
    {
        return $this->solvedReceipts[self::RECEIPT_BIG] ?? 0;
    }

    protected function clear()
    {
        $this->score = 0;
        $this->solvedReceipts = [
            self::RECEIPT_SMALL  => 0,
            self::RECEIPT_MEDIUM => 0,
            self::RECEIPT_BIG    => 0,
        ];
        $this->errors = [];
    }

    protected function processCalculation(array $data): void
    {
        $currentReceipt      = [];
        $currentReceiptType  = [];
        $currentReceiptScore = 0;
        $lastGoodTime        = null;
        $lastTime            = null;

        foreach($data as $record) {
            // receipt
            if($record['m'] == 'r') {
                $currentReceipt      = $record['d']['p'];
                $currentReceiptType  = $record['d']['t'];
                $currentReceiptScore = 0;
            }

            // product
            if($record['m'] == 'p') {
                $type = $record['d'];
                if(isset($currentReceipt[$type]) && --$currentReceipt[$type] >= 0) {
                    if($lastGoodTime - $record['t'] == 0) { // bonus extra time
                        $currentReceiptScore += self::GOOD_PRODUCT_EXTRA_BONUS_POINTS;
                    } else if($lastGoodTime - $record['t'] == 1) { // bonus time
                        $currentReceiptScore += self::GOOD_PRODUCT_BONUS_POINTS;
                    } else {
                        $currentReceiptScore += self::GOOD_PRODUCT_POINTS;
                    }

                    $lastGoodTime = $record['t'];
                }
            }

            // lays pack
            if($record['m'] == 'l') {
                $completed = true;
                foreach($currentReceipt as $remain) {
                    if($remain > 0) {
                        $completed = false;
                        break;
                    }
                }

                if($completed) {
                    $this->score += $currentReceiptScore * (self::RECEIPT_MULTIPLIERS[$currentReceiptType] ?? 0);
                    $this->solvedReceipts[$currentReceiptType]++;
                }
            }

            // break if game ended
            if(isset($record['t'])) {
                if(!is_null($lastTime) && $lastTime < $record['t']) {
                    break;
                }

                $lastTime = $record['t'];
            }
        }
    }
}