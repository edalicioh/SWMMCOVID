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
            [
                'district_name' => 'Areias',
                'district_coordinates' => '-27.0313994,-48.6592983',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
                'district_name' => 'Santa Regina',
                'district_coordinates' => '-27.0322696,-48.6709402',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
                'district_name' => 'Rio Pequeno',
                'district_coordinates' => '-27.0338833,-48.6370740',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
                'district_name' => 'Tabuleiro',
                'district_coordinates' => '-27.0080149,-48.6520969',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
                'district_name' => 'Monte Alegre',
                'district_coordinates' => '-27.0022545,-48.6654168',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
                'district_name' => 'Centro',
                'district_coordinates' => '-27.0218760, -48.6517795',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
        ];

        District::insert($district);
    }
}
