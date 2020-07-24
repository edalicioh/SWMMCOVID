<?php

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Company::create([
        'company_type'=> 2 ,
        'cnpj'=> '000' ,
        'company_name'=> 'Empresa',
        'address_id'=> DB::table('addresses')->pluck('id')[0],
       ]);
    }
}
