<?php

use Illuminate\Database\Seeder;
use App\Variable;

class VariablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $var = new Variable;
        $var->name = 'Var1';

        $var->save();

        $var = new Variable;
        $var->name = 'Var2';

        $var->save();

        $var = new Variable;
        $var->name = 'Var3';

        $var->save();

    }
}
