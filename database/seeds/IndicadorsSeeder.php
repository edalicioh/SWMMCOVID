<?php

use App\Models\Indicadors;
use Illuminate\Database\Seeder;

class IndicadorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicadors = [
            [
                'name' => 'AGUARDANDO'
            ],
            [
                'name' => 'NÃO DETECTAVEL'
            ],
            [
                'name' => 'CURADO'
            ],
            [
                'name' => 'OBITOS'
            ],

            [
                'name' => 'POSITIVO'
            ],
            [
                'name' => 'OUTRO'
            ],

        ];
        Indicadors::insert($indicadors);
    }
}
