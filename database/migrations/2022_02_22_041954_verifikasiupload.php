<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Verifikasiupload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasiupload', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->id();
            $table->string('verifikasiuploadcode')->nullable();
            $table->string('name');
            $table->string('filename');
            $table->integer('isactive');
            $table->integer('projectdetailcode');
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
        Schema::dropIfExists('verifikasiupload');
    }
}
