<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first user
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $plainPassword = '123';
        $user->password = app('hash')->make($plainPassword);
        $user->rank = '3';

        $user->save();

        $user = new User;
        $user->name = 'Client';
        $user->email = 'client@gmail.com';
        $plainPassword = '123';
        $user->password = app('hash')->make($plainPassword);
        $user->rank = '1';

        $user->save();

        $user = new User;
        $user->name = 'Engineer1';
        $user->email = 'eng1@gmail.com';
        $plainPassword = '123';
        $user->password = app('hash')->make($plainPassword);
        $user->rank = '2';

        $user->save();

        $user = new User;
        $user->name = 'Engineer2';
        $user->email = 'eng2@gmail.com';
        $plainPassword = '123';
        $user->password = app('hash')->make($plainPassword);
        $user->rank = '2';

        $user->save();

    }
}
