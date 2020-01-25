<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDm04attributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm04_attributions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('idordinateur');
            $table->string('ordinateur');
            $table->integer('idutilisateur');
            $table->string('nomutilisateur');
            $table->string('hdebut');
            $table->string('hfin');
            $table->integer('statut');
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
        Schema::dropIfExists('dm04_attributions');
    }
}
