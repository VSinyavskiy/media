<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::where('email', env('ADMIN_DEFAULT_EMAIL', 'admin@lays-doner.com'))->count() == 0) {
            $admin = User::create([
                'role' => User::ROLE_ADMIN,
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'phone' => '+996 (111) 11 11 11',
                'email' => env('ADMIN_DEFAULT_EMAIL', 'admin@lays-doner.com'),
                'password' => env('ADMIN_DEFAULT_PASSWORD', 'password'),
                'is_mail_confirmed' => 1,
            ])->save();
        }
    }
}
