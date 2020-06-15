<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string('indicator_name');
        });


        Schema::create('attendance_indicator', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('attendance_id');
            $table->unsignedBigInteger('indicator_id');

            $table->foreign('attendance_id')->references('id')->on('attendances');
            $table->foreign('indicator_id')->references('id')->on('indicators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_indicator');
        Schema::dropIfExists('indicators');

    }
}
