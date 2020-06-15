<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreatePlacesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeState(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('states')->insert([
                'state_name'     => $request->state_name,
                'uf'             => $request->uf,
                'state_coordinates' => $request->state_coordinates
            ]);



            DB::commit();
            toastr()->success('Dados Salvo com Sucesso :)');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCity(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('cities')->insert([
                'city_name'     => $request->city_name,
                'city_coordinates' => $request->city_coordinates,
                'state_id'      => $request->state_id
            ]);



            DB::commit();
            toastr()->success('Dados Salvo com Sucesso :)');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDistrict(Request $request)
    {
        try {

            DB::beginTransaction();

            DB::table('districts')->insert([
                'district_name'     => $request->district_name,
                'district_coordinates' => $request->district_coordinates,
                'city_id'           => $request->city_id
            ]);

            DB::commit();
            toastr()->success('Dados Salvo com Sucesso :)');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
        }
    }
}
