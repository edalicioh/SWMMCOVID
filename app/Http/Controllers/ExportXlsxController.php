<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use SimpleXLSXGen;

class ExportXlsxController extends Controller
{
    public function downloadXlsx()
    {
        /*  $books = [
            ['ISBN', 'title', 'author', 'publisher', 'ctry' ],
            [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
            [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
        ];
        $xlsx = SimpleXLSXGen::fromArray( $books );
        $xlsx->downloadAs('books.xlsx');

        data
        nome
        sexo
        idade
        CPF
        endereco
        bairro
        telefone
        data_sintomas
        sintomas
        comorbidade
        profissao
        observaoes
        coleta
        resultado_laboratorial
        data_resultado
        aconpanhamento
        data_alta
        status



        */

        $data = date('d-m-Y');
        $people = DB::table('people')
            ->join('addresses', 'people.address_id', '=', 'addresses.id')
            ->join('districts', 'addresses.district_id', '=', 'districts.id')
            ->join('attendances', 'people.id', '=', 'attendances.person_id')
            ->select("*", 'attendances.id AS aid', 'people.id AS pid')
            ->where('excluded', '=', null)
            ->get();
            $saida = [];
        $saida[] = [
            'data'          ,
            'nome'          ,
            'sexo'          ,
            'idade'         ,
            'CPF'           ,
            'endereco'      ,
            'bairro'        ,
            'telefone'      ,
            'data_sintomas' ,
            'sintomas'      ,
            'comorbidade'   ,
            'observaoes'    ,
            'resultado_laboratorial',
            'status'
        ];
        foreach ($people as $key => $value) {


            $saida[] = [
                'data'          => $value->date,
                'nome'          => $value->person_name,
                'sexo'          => $value->gender,
                'idade'         => $value->age,
                'CPF'           => $value->cpf,
                'endereco'      => $value->street . " " . $value->number,
                'bairro'        => $value->district_name,
                'telefone'      => $value->phone,
                'data_sintomas' => $value->discharge_date,
                'sintomas'      => $this->getSymptoms($value->aid),
                'comorbidade'   => $this->getDiseases($value->aid),
                'observaoes'    => $value->annotations,
                'resultado_laboratorial'    => $this->validateExam($value->exam_result? : 4),
                'status'        => $this->validateStatus($value->person_status),
            ];
        }

        $xlsx = SimpleXLSXGen::fromArray( $saida );
        $xlsx->downloadAs( "controle de casos COVID19 - {$data}.xlsx");

        return json_encode( true );

    }

    protected function validateStatus($status)
    {
        return Config::get('constants.STATUS')[$status];
    }

    protected function validateExam($status)
    {
        return Config::get('constants.ATTENDANCES')[$status];
    }

    protected function getSymptoms($atendancesId)
    {
        $symptoms = DB::table('attendances')
            ->where('attendances.id', $atendancesId)
            ->join('attendance_symptom', 'attendances.id', '=', 'attendance_symptom.attendance_id')
            ->leftjoin('symptoms', 'attendance_symptom.symptom_id', '=', 'symptoms.id')
            ->distinct()
            ->get();

        $symptomDescription = [];
        foreach ($symptoms  as $Skey => $value) {
            $symptomDescription[] =  $value->symptom_description;
        }
        return implode(', ', $symptomDescription);
    }

    protected function getDiseases($atendancesId)
    {
        $diseases = DB::table('attendances')
            ->where('attendances.id', $atendancesId)
            ->join('attendance_disease', 'attendances.id', '=', 'attendance_disease.attendance_id')
            ->leftJoin('diseases', 'attendance_disease.disease_id', '=', 'diseases.id')
            ->distinct()
            ->get();

        $diseasesDescription = [];
        foreach ($diseases  as $Skey => $value) {
            $diseasesDescription[] =  $value->disease_description;
        }
        return implode(', ', $diseasesDescription);
    }
}
