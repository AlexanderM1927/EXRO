<?php

use Illuminate\Database\Seeder;
use App\Variablesprojects;

class VariablesprojectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varpro = new Variablesprojects;
        $varpro->idproyecto = 1;
        $varpro->idvariable = 1;
        $varpro->max = 20;
        $varpro->min = 2;


        $varpro->save();

        $varpro = new Variablesprojects;
        $varpro->idproyecto = 1;
        $varpro->idvariable = 2;
        $varpro->max = 30;
        $varpro->min = 20;


        $varpro->save();

        $varpro = new Variablesprojects;
        $varpro->idproyecto = 1;
        $varpro->idvariable = 3;
        $varpro->max = 90;
        $varpro->min = 70;


        $varpro->save();
    }
}
