<?php

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'street' => 'São Paulo',
                'number' => '795',
                'observation' => "",
                'post_code' => "",
                'district_id' => DB::table('districts')->pluck('id')[0],
                'city_id' => DB::table('cities')->pluck('id')[0],
                'state_id' => DB::table('states')->pluck('id')[0],
            ],
        ];

        Address::insert($addresses);
    }
}
