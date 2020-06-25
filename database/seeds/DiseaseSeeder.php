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
            ['description'  =>  'Grávidas em qualquer idade gestacional, puérperas até duas semanas após o parto (incluindo as que tiveram aborto ou perda fetal)'],
            ['description'  =>  'Adultos ≥ 60 anos'],
            ['description'  =>  'Crianças < 5 anos (sendo que o maior risco de hospitalização é em menores de 2 anos, especialmente as menores de 6 meses com maior taxa de mortalidade)'],
            ['description'  =>  'População indígena aldeada ou com dificuldade de acesso'],
            ['description'  =>  'Indivíduos menores de 19 anos de idade em uso prolongado de ácido acetilsalicílico (risco de síndrome de Reye)'],
            ['description'  =>  'Indivíduos que apresentem'],
            ['description'  =>  'Pneumopatias (incluindo asma)'],
            ['description'  =>  'Pacientes com tuberculose de todas as formas (há evidências de maior complicação e possibilidade de reativação)'],
            ['description'  =>  'Cardiovasculopatias'],
            ['description'  =>  'Nefropatias'],
            ['description'  =>  'Hepatopatias'],
            ['description'  =>  'Doenças hematológicas (incluindo anemia falciforme)'],
            ['description'  =>  'Distúrbios metabólicos (incluindo diabetes mellitus)'],
            ['description'  =>  'Transtornos neurológicos e do desenvolvimento que podem comprometer a função respiratória ou aumentar o risco de aspiração (disfunção cognitiva, lesão medular epilepsia, paralisia cerebral, síndrome de Down, acidente vascular encefálico  - AVE ou doenças neuromusculares)'],
            ['description'  =>  'Imunossupressão associada a medicamentos (corticóide ≥ 20 mg/dia por mais de duas semanas, quimioterápicos, inibidores de TNF- alfa) neoplasias, HIV/aids ou outros'],
            ['description'  =>  'Obesidade (especialmente aqueles com índice de massa corporal – IMC ≥ 40 em adultos)']

        ];
        Disease::insert($disease);
    }
}
