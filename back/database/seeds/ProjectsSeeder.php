<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = new Project;
        $project->name = 'Project1';
        $project->descripcion = 'descripcion del proyecto 1';
        $project->idcliente = 2;

        $project->save();
    }
}
