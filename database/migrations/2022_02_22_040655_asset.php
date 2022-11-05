<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Asset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->engine = "InnoDB";
            // projectcode
            // nama project
            // nama pekerjaan
            // no.kontrak
            // nilai kontrak
            // masterasset
            $table->id();
            $table->integer('projectcode')->nullable();
            $table->string('projectname');
            $table->string('jobname');
            $table->integer('contractnumber');
            $table->integer('contractvalue');
            $table->string('masterasset');
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
        Schema::dropIfExists('asset');

    }
}
