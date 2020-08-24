<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('person_name')->nullable(true);
            $table->string('gender')->nullable(true);
            $table->string('cpf')->unique()->nullable(true);
            $table->string('sus_id')->unique()->nullable(true);
            $table->string('phone')->nullable(true);
            $table->dateTime('birth_date')->nullable(true);
            $table->integer('age')->nullable(true);
            $table->boolean('excluded')->nullable(true);
            $table->integer('work_status')->nullable(true);

            $table->integer('person_status')->nullable(true);
            $table->date('date_death')->nullable();

            $table->boolean('patient')->nullable(true);
            $table->dateTime('first_medical_care')->nullable(true);

            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions');

            $table->unsignedBigInteger('contaminations_id')->nullable();
            $table->foreign('contaminations_id')->references('id')->on('contaminations');

            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id')->references('id')->on('hospitals');

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
        Schema::dropIfExists('people');
    }
}
