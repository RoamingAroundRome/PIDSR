<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDRUSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drus', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('address_id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->boolean('national_sentinel_site')->nullable()->default(false);
            $table->boolean('philmis_site')->nullable()->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            // $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drus');
    }
}
