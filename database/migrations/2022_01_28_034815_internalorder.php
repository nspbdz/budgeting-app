<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class internalorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('internalorder', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            // $table->foreignId('userid')->unsigned()->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            // $table->integer('projectcode')->unsigned()->nullable();
            // $table->foreign('projectcode')
            // ->references('id')->on('project')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->integer('projectid');
            $table->string('name');
            $table->integer('isactive')->nullable();
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
        Schema::dropIfExists('internalorder');
     

    }
}
