<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('investigator_id');
            $table->unsignedBigInteger('disease_id');
            $table->unsignedBigInteger('patient_id');
            $table->timestamp('date_of_entry')->nullable()->default(now());
            $table->timestamp('date_admitted')->nullable();
            $table->timestamp('date_of_onset')->nullable();
            $table->timestamp('date_of_investigation')->nullable();
            $table->unsignedInteger('admit_to_entry')->nullable();
            $table->unsignedInteger('onset_to_admit')->nullable();
            $table->time('time_of_investigation')->nullable();
            $table->time('time_of_onset')->nullable();
            $table->string('interval_from_onset_to_notif')->nullable();
            $table->string('interval_from_notif_to_investigation')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('investigator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
