<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('application_type_id')->index()->unsigned();
            $table->foreign('application_type_id')->references('id')->on('application_types')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('district_id')->index()->unsigned();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('tehsil_id')->index()->unsigned();
            $table->foreign('tehsil_id')->references('id')->on('tehsils')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('city_id')->index()->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict')->onUpdate('cascade');
            $table->string('college_name', 50)->nullable();
            $table->text('college_address')->nullable();
            $table->string('college_email', 100)->nullable();
            $table->bigInteger('college_phone_no')->nullable();
            $table->integer('uc_no')->nullable();
            $table->integer('pp_no')->nullable();
            $table->integer('na_no')->nullable();
            $table->bigInteger('education_level_id')->index()->unsigned();
            $table->foreign('education_level_id')->references('id')->on('education_levels')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('gender_id')->index()->unsigned();
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('location_id')->index()->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('gender_registered_id')->index()->unsigned();
            $table->foreign('gender_registered_id')->references('id')->on('genders')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('shift_id')->index()->unsigned();
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('restrict')->onUpdate('cascade');
            $table->year('establishment_year')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('last_renewal_date')->nullable();
            $table->enum('affiliation', ['yes', 'no'])->default('no')->nullable();
            $table->string('affiliated_university_name')->nullable();
            $table->bigInteger('nature_of_ownership_id')->index()->unsigned();
            $table->foreign('nature_of_ownership_id')->references('id')->on('nature_of_ownerships')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('registration_status', ['registered', 'not-registered'])->default('not-registered')->nullable();
            $table->string('owner_name', 50)->nullable();
            $table->bigInteger('owner_principal_manager_phone_no')->nullable();
            $table->bigInteger('principal_cnic')->nullable();
            $table->integer('total_male_teachers')->default(0)->nullable();
            $table->integer('total_female_teachers')->default(0)->nullable();
            $table->integer('total_classrooms')->default(0)->nullable();
            $table->integer('total_rooms_other_than_classrooms')->default(0)->nullable();
            $table->bigInteger('area_type_id')->index()->unsigned();
            $table->foreign('area_type_id')->references('id')->on('area_types')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('area_value')->default(0)->nullable();
            $table->enum('has_library', ['yes', 'no'])->default('no')->nullable();
            $table->integer('total_books')->default(0)->nullable();
            $table->string('hygiene_certificate', 150)->nullable();
            $table->string('building_fitness_certificate', 150)->nullable();
            $table->string('map_of_college_building')->nullable();
            $table->string('ownership_rent_deed')->nullable();
            $table->string('last_fee_receipt', 50)->nullable();
            $table->enum('fee_status', ['paid', 'unpaid'])->default('unpaid')->nullable();
            $table->date('fee_payment_date')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
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
        Schema::dropIfExists('applications');
    }
}
