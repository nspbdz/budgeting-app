<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projectdetailapproval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectdetailapproval', function (Blueprint $table) {
            $table->id();
            $table->string('projectdetailid');
            $table->integer('userid');
            $table->integer('featuretype')->nullable();
            $table->string('approvaltype')->nullable();
            $table->integer('approvalstatus')->nullable();
            $table->timestamp('approvaldate')->useCurrent()->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('projectdetailapproval');

    }
}
