<?php

namespace App\Console\Commands;

use App\Game\Contracts\GamesStorageInterface;
use App\Game\Contracts\ReceiveGamePointsInterface;
use Illuminate\Console\Command;

class ProcessGameBonusPoints extends Command
{
    const TOP_RESULTS_COUNT   = 3;
    const BONUS_POINTS_NUMBER = 5;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send bonus game points to the receiver';

    protected $gamesStorage;

    /**
     * @var ReceiveGamePointsInterface
     */
    protected $receiver;

    /**
     * Create a new command instance.
     *
     * @param GamesStorageInterface $gamesStorage
     * @param ReceiveGamePointsInterface $receiver
     */
    public function __construct(GamesStorageInterface $gamesStorage, ReceiveGamePointsInterface $receiver)
    {
        parent::__construct();

        $this->gamesStorage = $gamesStorage;
        $this->receiver     = $receiver;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = new \DateTime('yesterday');

        $topResults = $this->gamesStorage::getTopResults($date, self::TOP_RESULTS_COUNT);

        $this->info(date('Y-m-d H:i:s') . ' | Trying to send bonus points for: ' . $date->format('Y-m-d') . ' ...');
        foreach($topResults as $result) {
            $isDone = $this->receiver->receiveGameTopPoints(
                $result->getPlayerId(),
                self::BONUS_POINTS_NUMBER,
                $result->getPlayerRank(),
                $result->getPlayedOn()
            );

            if($isDone) {
                $this->info('SUCCESS | Result ID #' . $result->getResultId() . '. User #' . $result->getPlayerId() . ' (' . $result->getPlayerName() . '). Rank #' . $result->getPlayerRank() . '. Score: ' . $result->getPlayerScore() . '. Played on: ' . $result->getPlayedOn()->format('d.m.Y H:i:s'));
            } else {
                $this->error('ERROR   | Result ID #' . $result->getResultId() . '. User #' . $result->getPlayerId() . ' (' . $result->getPlayerName() . '). Rank #' . $result->getPlayerRank() . '. Score: ' . $result->getPlayerScore() . '. Played on: ' . $result->getPlayedOn()->format('d.m.Y H:i:s'));
            }
        }
    }
}
