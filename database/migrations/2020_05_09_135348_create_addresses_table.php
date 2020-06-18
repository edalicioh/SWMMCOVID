<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street')->nullable(true);
            $table->string('number')->nullable(true);
            $table->string('observation')->nullable(true);
            $table->string('post_code')->nullable(true);

            $table->unsignedBigInteger('state_id')->nullable(true);
            $table->foreign('state_id')->references('id')->on('states');

            $table->unsignedBigInteger('city_id')->nullable(true);
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('district_id')->nullable(true);
            $table->foreign('district_id')->references('id')->on('districts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
