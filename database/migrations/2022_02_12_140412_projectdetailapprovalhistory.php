<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projectdetailapprovalhistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectdetailapprovalhistory', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->id();
            // $table->string('');
            $table->foreignId('userid')->unsigned()->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('projectdetailid')->unsigned()->nullable();
            $table->foreign('projectdetailid')
            ->references('id')->on('projectdetail')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('featuretype')->nullable();
            $table->string('approvaltype')->nullable();
            $table->integer('approvalstatus')->nullable();
            $table->timestamp('approvaldate')->useCurrent()->nullable();
            $table->string('notes')->nullable();
            $table->string('createdby')->nullable();
            $table->integer('updatedby')->nullable();
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
        Schema::dropIfExists('projectdetailapprovalhistory');

    }
}
