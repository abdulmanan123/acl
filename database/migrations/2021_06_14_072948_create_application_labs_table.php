<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_labs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('application_id')->index()->unsigned();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('lab_id')->index()->unsigned();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('application_labs');
    }
}
