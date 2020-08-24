<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CollectionLocation;
use App\Models\District;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ApiMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $positivo = 0;

    public function index()
    {
        $people = DB::table('people')
            ->join('addresses', 'people.address_id', '=', 'addresses.id')
            ->leftJoin('districts' , 'addresses.district_id' ,'=' ,'districts.id')
            ->where('excluded' ,'=' , null)
            ->where('district_coordinates' ,'!=' , '')


            ->where('person_status' ,'!=' , 0)
            ->select('person_status' , 'districts.*')
            ->get();
        $districts = DB::table('districts')->get();

        $cities = DB::table('cities')->get();

        if(!$people || !$districts || !$cities ){
            return json_encode(['error' => "400"]);
        }
        return json_encode([
            'data' => $this->groupByPeople($people)  ,
            'districts'=> $districts ,
            'cities' => $cities
        ]);

    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getDistrict($district_id)
    {
        $people = DB::table('people')
            ->join('addresses', 'people.address_id', '=', 'addresses.id')
            ->leftJoin('districts' , 'addresses.district_id' ,'=' ,'districts.id')
            ->where('districts.id' , '=' , $district_id)
            ->where('excluded' ,'=' , null)
            ->select('person_status' , 'districts.*')
            ->get();
        return json_encode(['data' => $this->groupByPeople($people)]);
    }

    protected function validaStatus($status, $value)
    {

       return [
         'quantidade' =>  $this->quantidadePositivo($status, $value),
         'tipo' => Config::get( 'constants.STATUS' )[$status]
       ];

    }

    protected function groupByPeople($people)
    {
        $data = [];
        $locais = [];
        $tipo = [];

        foreach ($people->groupBy('district_coordinates') as $key => $value) {
            $locais[] = ['position' => $key , 'name' => $value[0]->district_name , 'quantidade' => count( $value ) ];
        }

        $data['locais'] = $locais;

        foreach ($people->groupBy('person_status') as $key => $value) {
            $tipo[] =  $this->validaStatus($key , $value);

        }
        $tipo[] = [
            'quantidade' =>  $this->positivo,
            'tipo' => Config::get( 'constants.STATUS' )[1]
          ];


        $data['quantidade'] = $tipo;

        return $data;
    }

    protected function quantidadePositivo($status , $value)
    {
        if ($status > 1 && $status != 7) {
          $this->positivo += count($value);
        }
        return count($value);
    }

    public function getCityByState($state_id)
    {
        return DB::table('cities')->where('state_id' , '=' , $state_id)->get();
    }
    public function getDistrictsByCity($city_id)
    {
        return DB::table('districts')->where('city_id' , '=' , $city_id)->get();
    }

    public function getCollection()
    {
        $co =  CollectionLocation::all();
        dd($co);
    }

    public function getChartDistrict()
    {
        $districts = District::all();
        $d =[];
        foreach ($districts as $key => $district) {
            $people = DB::table('people')
                ->join('addresses', 'people.address_id', '=', 'addresses.id')
                ->leftJoin('districts' , 'addresses.district_id' ,'=' ,'districts.id')
                ->where('districts.id' , '=' , $district->id)
                ->where('excluded' ,'=' , null)
                ->select('person_status' , 'districts.*')
                ->get();
            $d[] = $this->groupByDistrict($people);
        }
        return json_encode($d);
    }

    protected function groupByDistrict ($people)
    {
        $tipo = '';
        foreach ($people->groupBy('district_coordinates') as $key => $value) {
            $tipo = $this->getQuantidade($value , $value[0]->district_name);

        }
        return $tipo;

    }

    public function getQuantidade($people, $name)
    {
        $tipo['name'] = $name ;
        foreach ($people->groupBy('person_status') as $key => $value) {
            $tipo[$key] =  $this->quantidadePositivo( $key, $value);

        }
        return $tipo;
    }

    public function getByGender($gender)
    {
        $people = DB::table('people')
            ->where('gender' ,'=' , $gender)
            ->where('excluded' ,'=' , null)
            ->select('person_status' , 'gender')
            ->get();

        $tipo = [] ;
        $positivo = 0;
        $recuperado = 0;

        foreach ($people->groupBy('person_status') as $key => $value) {
            if ( $key == 5) {
                $recuperado += count($value);
            }
            if ( $key > 1 &&  $key != 7) {
                $positivo += count($value);
            }

        };
        return json_encode([
            [
                'name' => 'Tratamento',
                'value' => $positivo -  $recuperado ,
            ],
            [
                'name' => 'Recuperado',
                'value' => $recuperado
            ]
        ]);
    }

    public function getAgeByGender()
    {
        $masc = Person::where('excluded' ,'=' , null)->where('gender' ,'=' , 'M')->get();
        $fem = Person::where('excluded' ,'=' , null)->where('gender' ,'=' , 'F')->get();

        $totalM = count( $masc);
        $totalF = count( $fem);


        $positivoM = $this->countByStatusFromGender($masc);
        $positivoF = $this->countByStatusFromGender($fem);

        $percentageF = $this->percentageByAge($positivoF , $totalF);
        $percentageM = $this->percentageByAge($positivoM , $totalM);
        $saida = [];
        foreach ($percentageF as $key => $value) {
            $age = "";
                if ($key ==  'mais60' ){
                    $age = "+60";
                } else if ($key ==  'mais40' ){
                    $age = "60-40";
                } else if ($key ==  'mais30' ){
                    $age = "40-30";
                } else if ($key ==  'mais20' ){
                    $age = "30-20";
                } else if ($key ==  'mais10' ){
                    $age = "20-10";
                } else if ($key ==  'menos10'){
                    $age = "-10";
                }
            $saida[] = [
                "age" => $age,
                "male" => -$percentageM[$key] ,
                "female" => $percentageF[$key]
            ];
        }
        return json_encode($saida);

    }

    protected function countByStatusFromGender($gender)
    {
        $mais60 = 0;
        $mais40 = 0;
        $mais30 = 0;
        $mais20 = 0;
        $mais10 = 0;
        $menos10 = 0;
        $gruop = [];
        foreach ($gender->groupBy("person_status") as $key => $value) {
            if ( $key > 1 &&  $key != 7) {
                $gruop[$key] = $this->countByAgeFrom($value);
            }
        }
        foreach ($gruop as $key => $value) {

            $mais60  +=  $value['mais60'];
            $mais40  +=  $value['mais40'];
            $mais30  +=  $value['mais30'];
            $mais20  +=  $value['mais20'];
            $mais10  +=  $value['mais10'];
            $menos10 +=  $value['menos10'];


        }

        return [
            "mais60" => $mais60,
            "mais40" => $mais40,
            "mais30" => $mais30,
            "mais20" => $mais20,
            "mais10" => $mais10,
            "menos10" => $menos10,
        ];
    }

    protected function countByAgeFrom($gender)
    {
        $mais60 = 0;
        $mais40 = 0;
        $mais30 = 0;
        $mais20 = 0;
        $mais10 = 0;
        $menos10 = 0;
        foreach ($gender as $Qkey => $Qvalue) {

            $age = $Qvalue->age;
            if ($age >= 60 ) {
                $mais60++;
            } else if ($age < 60 && $age >= 40 ) {
                $mais40++;
            } else if ($age < 40 && $age >= 30 ) {
                $mais30++;
            } else if ($age < 30 && $age >= 20 ) {
                $mais20++;
            } else if ($age < 20 && $age >= 10 ) {
                $mais10++;
            } else {
                $menos10++;
            }
        }
        return [
            "mais60" => $mais60,
            "mais40" => $mais40,
            "mais30" => $mais30,
            "mais20" => $mais20,
            "mais10" => $mais10,
            "menos10" => $menos10,
        ];
    }

    protected function percentageByAge($gender , $total)
    {
        $saida = [];
        foreach ($gender as $key => $value) {
            $saida[$key] = round(( (  $value / $total ) * 100 ) , 2);
        }
        return $saida;
    }

    public function getMovingAverage ( )
    {
        $people = DB::table('people')
                    ->where('excluded' ,'=' , null)
                    ->where('person_status' ,'=' , 6)
                    ->orderBy("date_death",'asc')
                    ->get();

        $group = $people->groupBy('date_death');

        foreach ($people as $key => $value) {

            $timestamp = date('Y-m-d H:i:s',date(strtotime("-14 day", strtotime($value->date_death))));
            $total = DB::table('people')
                            ->where('excluded' ,'=' , null)
                            ->where('person_status' ,'=' , 6)
                            ->where('date_death' ,'<' ,$timestamp )
                            ->orderBy("date_death",'asc')
                            ->get();

            $MM[$value->date_death]['quantidade'] = count( $group[$value->date_death]) ;
            $MM[$value->date_death]['media']      = round( count($total) / 14 ,2) ;
            $MM[$value->date_death]['data']       = $value->date_death;
        }
        //->where('date_death' ,'>' ,  $timestamp)

        $saida = [];

        foreach ($MM as $key => $value) {
            $saida[] = $value;
        }
        return json_encode($saida);
    }

    public function getPropagation()
    {
       // Número de casos novos determinado período (14dias)*100.000)/ população total

       $people = DB::table('people')
                    ->leftJoin('exams' , 'people.id' ,'=' ,'exams.person_id')
                    ->where('excluded' ,'=' , null)
                    ->where('person_status' ,'>' , 1)
                    ->where('person_status' ,'!=' , 7)
                    ->orderBy("result_date",'asc')
                    ->get();

        $group = $people->groupBy('result_date');
        $MM = [];
        $saida= [];
        foreach ($group as $key => $value) {
            if ($key != "") {
                $timestamp = date('Y-m-d H:i:s',date(strtotime("-14 day", strtotime($key))));
                $total = DB::table('people')
                    ->leftJoin('exams' , 'people.id' ,'=' ,'exams.person_id')
                    ->where('excluded' ,'=' , null)
                    ->where('person_status' ,'=' , 6)
                    ->where('result_date' ,'<' ,$timestamp )
                    ->orderBy("result_date",'asc')
                    ->get();
                if (count($total) > 0) {
                    $MM[$key]['quantidade'] = count( $group[$key]) ;
                    $MM[$key]['media']      = round( (count($total) * 100.000) / Config::get('constants.populacao_camboriu') ,2) ;
                    $MM[$key]['data']       = $key;
                }
            }
        }
        foreach ($MM as $key => $value) {
            $saida[] = $value;
        }
        return json_encode($saida);
    }

    public function getLetalidade()
    {
        // Letalidade:  (nº mortes X 100) / nº casos
        // Mortalidade: (nº de mortalidades X 100.000)/população total
        $totalDia = 0;
        $totalMorte = 0;
        $people = DB::table('people')
                ->leftJoin('exams' , 'people.id' ,'=' ,'exams.person_id')
                ->where('excluded' ,'=' , null)
                ->where('person_status' ,'>' , 1)
                ->where('person_status' ,'!=' , 7)
                ->orderBy("result_date",'asc')
                ->get();

        foreach ($people->groupBy('result_date') as $key => $value) {


            $totalDia += count($value);


            foreach ($value as  $person) {
                if ($person->person_status == 6) {
                    $totalMorte++;
                }
            }


            $letalidate = $totalMorte > 0
                            ? ($totalMorte * 100) / $totalDia
                            : 0 ;
            $mortalidate = $totalMorte > 0
                            ? ($totalMorte * 100.000) / Config::get('constants.populacao_camboriu')
                            : 0 ;

            if ( $key ) {
                if ($totalMorte > 0) {
                    $MM[$key]['letalidate']   = round( $letalidate ,2) ;
                    $MM[$key]['mortalidate']  = round( $mortalidate  ,2) ;
                    $MM[$key]['date']         = $key;
                    $MM[$key]['nada']         = $totalMorte;
                    $MM[$key]['total']         = $totalDia;

                }

            }

        }



        $saida = [];

        foreach ($MM as $key => $value) {
            $saida[] = $value;
        }
        return json_encode($saida);

    }

}
