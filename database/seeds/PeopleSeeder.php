<?php

use App\Models\Person;
use Illuminate\Database\Seeder;
class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Person::class, 1)->create();
    }
}
