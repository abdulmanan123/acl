<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationEnrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_enrollment', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('application_id')->index()->unsigned();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('program_id')->index()->unsigned();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('male_students')->nullable()->default(0);
            $table->integer('female_students')->nullable()->default(0);
            $table->bigInteger('created_by')->index()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('updated_by')->index()->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_enrollment');
    }
}
