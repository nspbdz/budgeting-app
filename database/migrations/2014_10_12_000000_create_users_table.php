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
            // $table->increments('id');

            $table->string('username')->unique();
            $table->string('mobilephone')->nullable();
            $table->string('email')->unique();
            $table->string('jabatan')->nullable();
            $table->string('namadepan')->nullable();
            $table->string('namabelakang')->nullable();
            $table->string('password');
            $table->string('position')->nullable();
            $table->string('nip')->nullable();
            $table->integer('departementid')->nullable();
            $table->integer('teamid')->nullable();
            $table->string('leaderteam')->nullable();
            $table->string('departmenthead')->nullable();
            $table->integer('accessid')->nullable();
            $table->integer('isteamleader')->nullable();
            $table->integer('isactive');
            $table->string('createdby')->nullable();
            $table->integer('updatedby')->nullable();
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
