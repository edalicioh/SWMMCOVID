<?php

use App\Models\Disease;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disease = [
            ['description'  =>  'Doença hepática'],
            ['description'  =>  'Diabetes'],
            ['description'  =>  'Cardiopatia'],
            ['description'  =>  'Obesidade'],
            ['description'  =>  'Imunodepressão'],
            ['description'  =>  'Doença renal'],
            ['description'  =>  'Pneumopatia'],
            ['description'  =>  'Doença hematológica'],
            ['description'  =>  'Puérpera'],
            ['description'  =>  'Doença neurológica'],
            ['description'  =>  'Asma'],
            ['description'  =>  'Síndrome de Down'],
            ['description'  =>  'Doença hepática']

        ];
        Disease::insert($disease);
    }
}
