<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('login')->unique();
            $table->string('numero_telephone')->unique();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->integer('role_id')->unsigned();
            $table->string('photo_profil')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->datetime('password_change_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
