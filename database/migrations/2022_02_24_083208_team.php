<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Team extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->engine = "InnoDB";

            // $table->id();
            $table->increments('id');

            $table->string('teamcode')->nullable();
            $table->string('name');
            $table->integer('teamleader');
            // $table->foreignId('departementcode')->unsigned()->constrained('departement')->onDelete('cascade')->onUpdate('cascade')->nullable();
            // $table->foreignId('teamleader')->unsigned()->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            // $table->integer('teamleader')->nullable();
            $table->integer('departementcode')->unsigned()->nullable();
            // $table->foreign('departementcode')
            // ->references('id')->on('departement')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->integer('isactive');
            $table->string('createdby')->nullable();
            $table->string('updatedby')->nullable();
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
        Schema::dropIfExists('team');
        //
    }
}
