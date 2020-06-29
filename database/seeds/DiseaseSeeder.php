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
            ['disease_description'  =>  'Grávidas em qualquer idade gestacional, puérperas até duas semanas após o parto (incluindo as que tiveram aborto ou perda fetal)'],
            ['disease_description'  =>  'Adultos ≥ 60 anos'],
            ['disease_description'  =>  'Crianças < 5 anos (sendo que o maior risco de hospitalização é em menores de 2 anos, especialmente as menores de 6 meses com maior taxa de mortalidade)'],
            ['disease_description'  =>  'População indígena aldeada ou com dificuldade de acesso'],
            ['disease_description'  =>  'Indivíduos menores de 19 anos de idade em uso prolongado de ácido acetilsalicílico (risco de síndrome de Reye)'],
            ['disease_description'  =>  'Indivíduos que apresentem'],
            ['disease_description'  =>  'Pneumopatias (incluindo asma)'],
            ['disease_description'  =>  'Pacientes com tuberculose de todas as formas (há evidências de maior complicação e possibilidade de reativação)'],
            ['disease_description'  =>  'Cardiovasculopatias'],
            ['disease_description'  =>  'Nefropatias'],
            ['disease_description'  =>  'Hepatopatias'],
            ['disease_description'  =>  'Doenças hematológicas (incluindo anemia falciforme)'],
            ['disease_description'  =>  'Distúrbios metabólicos (incluindo diabetes mellitus)'],
            ['disease_description'  =>  'Transtornos neurológicos e do desenvolvimento que podem comprometer a função respiratória ou aumentar o risco de aspiração (disfunção cognitiva, lesão medular epilepsia, paralisia cerebral, síndrome de Down, acidente vascular encefálico  - AVE ou doenças neuromusculares)'],
            ['disease_description'  =>  'Imunossupressão associada a medicamentos (corticóide ≥ 20 mg/dia por mais de duas semanas, quimioterápicos, inibidores de TNF- alfa) neoplasias, HIV/aids ou outros'],
            ['disease_description'  =>  'Obesidade (especialmente aqueles com índice de massa corporal – IMC ≥ 40 em adultos)']

        ];
        Disease::insert($disease);
    }
}
