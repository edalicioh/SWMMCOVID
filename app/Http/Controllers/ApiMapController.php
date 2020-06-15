<?php

namespace App\Http\Controllers;

use App\Models\Address;
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
        if ($status > 1) {
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

}
