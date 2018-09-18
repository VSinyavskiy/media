<?php


namespace App\Services;


use App\Game\Contracts\GameCalculatorInterface;
use App\Game\Contracts\GamesStorageInterface;
use Illuminate\Contracts\Auth\Guard as AuthGuardInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class GameDataService
 * @package App\Services
 */
class GameDataService
{
    /**
     * @var AuthGuardInterface
     */
    protected $auth;

    /**
     * @var GameCalculatorInterface
     */
    protected $calculator;

    /**
     * @var GamesStorageInterface
     */
    protected $storage;

    /**
     * GameDataService constructor.
     *
     * @param AuthGuardInterface $auth
     * @param GameCalculatorInterface $calculator
     * @param GamesStorageInterface $storage
     */
    public function __construct(AuthGuardInterface $auth, GameCalculatorInterface $calculator, GamesStorageInterface $storage)
    {
        $this->auth       = $auth;
        $this->calculator = $calculator;
        $this->storage    = $storage;
    }

    /**
     * Check user authentication and return valid response for the game
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkUserAuthentication(): JsonResponse
    {
        return response()->json([
            'result' => $this->auth->check() ? 'ok' : 'not_authenticated',
        ]);
    }

    /**
     * Calculate game data, save to DB and make valid response for the game
     *
     * @param array $gameData
     * @return JsonResponse
     */
    public function processGameData(array $gameData): JsonResponse
    {
        // check authentication
        if($this->auth->check() == false) {
            return $this->checkUserAuthentication();
        }

        // calculate game data
        $this->calculator->calculate($gameData);

        // check calculation errors
        if($this->calculator->hasErrors()) {
            return response()->json([
                'result' => 'error',
                'errors' => $this->calculator->getErrors(),
            ]);
        }

        // save game record
        $resultId = $this->storage::saveGameResult($this->auth->id(), $this->calculator->getScore(), $gameData);
        // check saving error
        if(is_null($resultId)) {
            return response()->json([
                'result' => 'error',
                'errors' => ['Game result not saved'],
            ]);
        }

        // get top and make valid struct for the game
        $results = $this->storage::getTopResults(new \DateTime(), 4, $resultId);
        $top     = [];

        foreach($results as $result) {
            $top[] = [
                'name'   => $result->getPlayerName(),
                'score'  => $result->getPlayerScore(),
                'place'  => $result->getPlayerRank(),
                'its_my' => $result->getResultId() == $resultId,
                'its_me' => $result->getPlayerId() == $this->auth->id(),
            ];
        }

        // return valid response
        return response()->json([
            'result' => 'ok',
            'score'  => $this->calculator->getScore(),
            'doners' => [
                'small'  => $this->calculator->getSmallDonersCount(),
                'medium' => $this->calculator->getMediumDonersCount(),
                'big'    => $this->calculator->getBigDonersCount(),
            ],
            'top' => $top,
        ]);
    }
}