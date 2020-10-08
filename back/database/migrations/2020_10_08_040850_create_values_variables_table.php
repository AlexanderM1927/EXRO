<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuesVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values_variables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idreport')->references('id')->on('reports');
            $table->integer('idvariablesprojects')->references('id')->on('variablesprojects');
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
        Schema::dropIfExists('values_variables');
    }
}
