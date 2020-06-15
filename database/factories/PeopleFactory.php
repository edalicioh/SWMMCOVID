<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Person;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'first_medical_care' => $faker->date('2020-03-11'),
        'cpf' => $faker->unique()->randomDigit(13),
        'gender' => 'F',
        'sus_id' => $faker->randomDigit(13),
        'birth_date' => $faker->date(),
        'phone' => $faker->phoneNumber(),
        'age' => $faker->randomDigit(2),
        'status' => 0 ,
        'work_status' => 0,
        'patient' => true,
        'contaminations_id' => null,
        'address_id' => 1,
        'user_id' => DB::table('companies')->pluck('id')[0],
        'company_id' => null,
    ];
});
