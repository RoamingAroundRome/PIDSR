<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('disease_id');
            $table->string('section')->nullable(); // e.g. Clinical Data, Final Classification & Outcome
            $table->string('type')->nullable(); // type: email, date, number, text
            $table->string('component')->nullable(); // the vuetify component input field to be used
            $table->string('hint')->nullable(); // the question e.g. 'when did the baby have bloody diarrhea?'
            $table->string('question')->nullable(); // the question e.g. 'when did the baby have bloody diarrhea?'
            $table->string('answer')->nullable(); // just a blank field
            $table->json('choices')->nullable(); // array of choices
            $table->boolean('display')->default(true); // to display the form input field
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('disease_fields', function (Blueprint $table) {
            $table->foreign('disease_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_fields');
    }
}
