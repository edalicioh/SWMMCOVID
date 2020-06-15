<?php

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'city_name' => 'Camboriú',
            'city_coordinates' => '-27.0273601,-48.6535657',
            'state_id' => DB::table('states')->pluck('id')[0]
        ]);
    }
}
