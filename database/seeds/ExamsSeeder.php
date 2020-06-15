<?php

use App\Models\Exam;
use App\Models\Person;
use Illuminate\Database\Seeder;

class ExamsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $Exams = [
      [
        'description' => '',
        'address_id' => null,
        'status' => 0,
      ], [
        'description' => '',
        'address_id' => null,
        'status' => 2,
      ], [
        'description' => 'não infectado',
        'address_id' => null,
        'status' => 0,
      ],
    ];

    $exams = Exam::insert($Exams);

    Person::find(1)->exams()->attach(
      1,
      [
        'performed_date' => '2020-03-20',
      ]
    );


    Person::find(2)->exams()->attach(
      2,
      [
        'performed_date' => '2020-04-20',
      ]
    );


    Person::find(2)->exams()->attach(
      3,
      [
        'performed_date' => '2020-05-20',
      ]
    );
  }
}
