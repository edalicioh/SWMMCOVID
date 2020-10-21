<?php

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $district = [

            [
                'district_name' => 'Não informado',
                'district_coordinates' => '-27.0273601,-48.6535657',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],

        ];

        District::insert($district);
    }
}
