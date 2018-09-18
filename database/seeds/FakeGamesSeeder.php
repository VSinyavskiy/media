<?php

use App\Game\Contracts\GamesStorageInterface;
use App\Models\GameData;
use App\Models\User;
use Illuminate\Database\Seeder;

class FakeGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param GamesStorageInterface $storage
     * @return void
     */
    public function run(GamesStorageInterface $storage)
    {
//        factory(User::class, 5000)->create();
        factory(GameData::class, 500)->make()->each(function($d) use($storage) {
            $storage::saveGameResult($d->user_id, $d->score, [$d->game_log]);
        });
    }
}
