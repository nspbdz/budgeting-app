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

        Schema::create('project', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('projectcode');
            $table->string('subprojectcode');
            $table->string('nilaifs')->nullable();
            $table->string('filenamefs')->nullable(); 
            $table->integer('pic');
            $table->string('fsyear')->nullable();
            $table->string('targetlive')->nullable();
            $table->string('budgetallocationyear')->nullable();
            $table->string('budgetallocationtarget')->nullable();
            $table->string('paymentmethode');
            $table->string('projectname');
            $table->string('initiativename');
            $table->string('budgetallocation');
            $table->integer('isactive');
            $table->string('createdby')->nullable();
            $table->string('updatedby')->nullable();
            // $table->foreignId('iocode')->constrained('internalorder')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
       
        Schema::create('projectdetail', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            
            $table->foreignId('iocode')->unsigned()->constrained('internalorder')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('projectcode')->unsigned()->nullable();
            $table->foreign('projectcode')
            ->references('id')->on('project')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        // Schema::dropIfExists('internalorder');

        Schema::dropIfExists('projectdetail');
        Schema::dropIfExists('project');
        // Schema::dropIfExists('internalorders');

    }
}
