<?php

use Illuminate\Database\Seeder;
use App\ValuesVariable;

class ValuesVariablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valvar = new ValuesVariable;
        $valvar->idreport = 1;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 15;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 2;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 16;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 3;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 17;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 4;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 14;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 5;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 13;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 6;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 15;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 7;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 11;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 8;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 10;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 9;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 19;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 10;
        $valvar->idvariablesprojects = 1;
        $valvar->value = 13;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 11;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 22;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 12;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 24;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 13;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 25;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 14;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 25;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 15;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 26;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 16;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 27;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 17;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 26;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 18;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 24;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 19;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 29;

        $valvar->save();

        $valvar = new ValuesVariable;
        $valvar->idreport = 20;
        $valvar->idvariablesprojects = 2;
        $valvar->value = 30;

        $valvar->save();
    }
}
