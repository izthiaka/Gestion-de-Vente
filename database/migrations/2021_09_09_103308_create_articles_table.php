<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_article')->unique();
            $table->text('description_article')->nullable();
            $table->integer('prix_article');
            $table->integer('categorie_id')->unsigned();
            $table->string('photo_article')->nullable();
            $table->boolean('disponibilite')->nullable();
            $table->integer('quantite_article')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
