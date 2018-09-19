<?php

namespace App\Providers;

use App\Game\Contracts\GameCalculatorInterface;
use App\Game\Contracts\GamesStorageInterface;
use App\Game\Contracts\ReceiveGamePointsInterface;
use App\Game\GameCalculator;
use App\Models\GameData;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\UserPointsLog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReceiveGamePointsInterface::class, function($app) {
            return new UserPointsLog();
        });

        $this->app->singleton(GamesStorageInterface::class, function($app) {
            return new GameData();
        });

        $this->app->singleton(GameCalculatorInterface::class, function($app) {
           return new GameCalculator();
        });
    }
}
