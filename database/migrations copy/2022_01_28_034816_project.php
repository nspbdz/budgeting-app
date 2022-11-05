<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internalorders', function (Blueprint $table) {
            $table->id();
            $table->string('iocode');
            $table->string('name');
            // $table->string('initiativename')->nullable();
            $table->integer('isactive')->nullable();
            $table->string('createdby')->nullable();
            $table->string('updatedby')->nullable();
            $table->timestamps();
        });
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('projectcode');
            $table->string('iocode')->nullable();
            $table->string('projectname');
            $table->string('initiativename');
            $table->string('budgetallocation');
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
        Schema::dropIfExists('projects');

    }
}
