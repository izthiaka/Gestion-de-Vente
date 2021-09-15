<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovisionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->integer('quantite_approv_depart');
            $table->integer('quantite_approv_retour')->nullable();
            $table->integer('quantite_restant')->nullable();
            $table->dateTime('date_retour')->nullable();
            $table->integer('activite');
            $table->boolean('confirmed')->nullable();
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
        Schema::dropIfExists('approvisionnements');
    }
}
