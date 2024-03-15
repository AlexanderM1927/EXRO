<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersSeeder');
        $this->call('ProjectsSeeder');
        $this->call('VariablesSeeder');
        $this->call('VariablesProjectsSeeder');
        $this->call('ReportsSeeder');
        $this->call('ValuesVariablesSeeder');
        $this->call('SettingsSeeder');


    }
}
