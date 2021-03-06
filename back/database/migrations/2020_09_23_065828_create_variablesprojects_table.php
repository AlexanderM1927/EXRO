<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variablesprojects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idproyecto');
            $table->integer('idvariable');
            $table->float('max')->nullable();
            $table->float('min')->nullable();
            $table->string('razon_outrange')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variablesprojects');
    }
}
