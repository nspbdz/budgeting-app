\<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Departement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departement', function (Blueprint $table) {
            $table->engine = "InnoDB";
            // $table->id();
            $table->increments('id');

            $table->string('departementcode')->nullable();
            $table->string('name');
            $table->integer('departmenthead');
            // $table->foreignId('departmenthead')->unsigned()->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
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
        Schema::dropIfExists('departement');

    }
}
