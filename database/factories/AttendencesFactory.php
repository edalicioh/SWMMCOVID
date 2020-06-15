<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Attendence;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Attendence::class, function (Faker $faker) {
    return [
        'date' => $faker->date('2020-04-30'),
        'exam' => $faker->text(),
        'annotations' => $faker->text(),
        'person_id' => DB::table('people')->pluck('id')[0]
    ];
});
