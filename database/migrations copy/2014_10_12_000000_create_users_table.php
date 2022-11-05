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
            $table->string('namadepan')->nullable();
            $table->string('namabelakang')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('position')->nullable();
            $table->string('nip')->nullable();
            $table->integer('accessid')->nullable();
            $table->string('leaderteamname')->nullable();
            $table->string('validatorname')->nullable();
            $table->integer('isactive');
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
