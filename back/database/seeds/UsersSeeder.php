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
        $user->name = 'Alexander';
        $user->email = 'jhon71937@gmail.com';
        $plainPassword = 'adm';
        $user->password = app('hash')->make($plainPassword);
        $user->rank = '3';

        $user->save();
    }
}