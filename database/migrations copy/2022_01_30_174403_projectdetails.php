<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projectdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectdetails', function (Blueprint $table) {
            $table->id();
            $table->string('projectcode');
            $table->string('iocode')->nullable();
            $table->string('projectname');
            $table->string('initiativename');
            $table->string('vendorname');
            $table->string('jobdetail');
            $table->string('budgetallocation');
            $table->string('noformrequest')->nullable();
            $table->string('requestuploadfrom')->nullable();
            $table->string('kontraknumber')->nullable();
            $table->string('bastno')->nullable();
            $table->string('sppno')->nullable();
            $table->integer('qtyupload')->nullable();
            $table->integer('totalupload')->nullable();
            $table->string('note')->nullable();
            $table->string('notano')->nullable();
            $table->string('file')->nullable();
            $table->string('masterasset')->nullable();
            $table->integer('isactive')->nullable();
            $table->integer('crosscheck')->nullable();
            $table->string('crosscheckby')->nullable();
            $table->timestamp('crosscheckdate')->useCurrent()->nullable();
            $table->integer('lastapproval')->nullable();
            $table->integer('lastapprovalstatus')->nullable();
            $table->timestamp('lastapprovaldate')->useCurrent()->nullable();
            $table->string('lastapprovalnotes')->nullable();
            $table->integer('lastverifyupload')->nullable();
            $table->integer('lastverifystatus')->nullable();
            $table->timestamp('lastaverifieddate')->useCurrent()->nullable();
            $table->string('lastverifiednotes')->nullable();
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
        Schema::dropIfExists('projectdetails');

    }
}
