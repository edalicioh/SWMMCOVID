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
            [
                'district_name' => 'Cedro',
                'district_coordinates'    => '-27.0375469,-48.6456812',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
                'district_name' => 'Braço',
                'district_coordinates'    => '-27.0889515,-48.7464283',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
               'district_name' =>  'Conde Vila Verde',
               'district_coordinates'    => '-27.0042972,-48.6706478',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
           [
               'district_name' =>  'Lídia Duarte',
               'district_coordinates'     => '-27.0365745,-48.6544576',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
               'district_name' =>  'Macacos',
                'district_coordinates'    => '-27.0791186,-48.6858301',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
            [
               'district_name' =>  'São Francisco de Assis',
               'district_coordinates'     => '-27.0215201,-48.6367202',
                'city_id' => DB::table('cities')->pluck('id')[0]
            ],
        ];

        District::insert($district);
    }
}
