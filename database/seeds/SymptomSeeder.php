<?php

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symptom = [

        [ 'symptom_description' => 'ASSINTOMATICA'],
        [ 'symptom_description' => 'TOSSE SECA'],
        [ 'symptom_description' => 'FEBRE'],
        [ 'symptom_description' => 'DISPNEIA/DESCONFORTO'],
        [ 'symptom_description' => 'RESPIRÁTORIO'],
        [ 'symptom_description' => 'MIALGIA	DOR DE GARGANTA'],
        [ 'symptom_description' => 'DIARREIA/VÔMITOS'],
        [ 'symptom_description' => 'CEFALEIA'],
        [ 'symptom_description' => 'FARINGITE'],
        [ 'symptom_description' => 'CONGESTÃO NASAL	DOR TORÁXICA'],
        [ 'symptom_description' => 'PERDA DO OLFATO/PALADAR'],
        [ 'symptom_description' => 'PERDA DE FOME'],
        [ 'symptom_description' => 'CORIZA'],
        [ 'symptom_description' => 'OUTROS']

        ];

        Symptom::insert($symptom);
    }
}
