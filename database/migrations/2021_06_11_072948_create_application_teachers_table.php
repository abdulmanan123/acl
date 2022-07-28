<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_teachers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('application_id')->index()->unsigned();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('qualification_id')->index()->unsigned();
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('male_count')->nullable()->default(0);
            $table->integer('female_count')->nullable()->default(0);
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
        Schema::dropIfExists('application_teachers');
    }
}
