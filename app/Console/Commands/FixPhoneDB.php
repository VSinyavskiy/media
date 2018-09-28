<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class FixPhoneDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixdb:phone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete __ in every phone number in db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        echo '----Start command' . "\n";
        foreach ($users as $user) {
            $user->phone = str_replace(['_', ' '], '', $user->phone);
            $user->save();

            echo 'User ' . $user->id . " successfily updated\n";            
        }
        echo '----End command'  . "\n";
    }
}
