<?php

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'state_name' => 'Santa Catarina',
            'uf' => 'SC',
            'state_coordinates' => '-27.0628367,-51.1149650'
        ]);
    }
}
