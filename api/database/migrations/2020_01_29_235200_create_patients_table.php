<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_no')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('ethnicity')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_4P_member')->nullable()->default(false);
            $table->boolean('inter_local_health_zone')->nullable()->default(false);
            $table->string('blood_type')->nullable();
            $table->string('rh_type')->nullable();
            $table->date('date_of_death')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
