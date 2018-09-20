<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Services\GameDataService;
use Illuminate\Http\Request;

/**
 * Class GameController
 * @package App\Http\Controllers\App
 */
class GameController extends Controller
{
    /**
     * @var GameDataService
     */
    protected $service;

    /**
     * GameController constructor.
     *
     * @param GameDataService $service
     */
    public function __construct(GameDataService $service)
    {
        $this->service = $service;
    }

    public function game()
    {
        $results = $this->service->getTodayResultsWithUserBest(5);

        return view('app.game', compact('results'));
    }

    public function iframe()
    {
        return view('app.game.iframe');
    }

    /**
     * Check is user currently authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth()
    {
        return $this->service->checkUserAuthentication();
    }

    /**
     * Save user's game result and return response for the game
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function results(Request $request)
    {
        $gameData = $request->all();

        return $this->service->processGameData($gameData);
    }
}
