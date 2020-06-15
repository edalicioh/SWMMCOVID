<?php

namespace App\Http\Controllers;

use App\Http\Requests\HospitalStoreUpdate;
use App\Models\Address;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $hospitais = Hospital::all();

            return DataTables::of($hospitais)->make(true);
        }

        return view('dashboard/pages/hospital/index' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = DB::table('districts')->get();
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();

        return view('dashboard/pages/hospital/create' , compact(['cities' , 'states','districts']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HospitalStoreUpdate  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HospitalStoreUpdate $request)
    {
        try {
            DB::beginTransaction();

            $request->address_id = (new AddressController())->store($request, true);

            Hospital::create($request->all());

            DB::commit();

            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('admin/hospital');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        $address = $hospital->address()->first();
        $districts = DB::table('districts')->get();
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();

        return view('dashboard/pages/hospital/create' , compact(
            [
                'cities',
                'states',
                'districts',
                'hospital',
                'address'
            ]
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {
        try {

            DB::beginTransaction();

                $address = Address::where('id',  $hospital->address_id)->first();
                (new AddressController)->update($request,$address);

                $hospital->hospital_name        = $request->hospital_name;
                $hospital->icu_beds             = $request->icu_beds;
                $hospital->infirmary_beds       = $request->infirmary_beds;
                $hospital->hospital_location    = $request->hospital_location;
                $hospital->update();

            DB::commit();
            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/hospital');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        //
    }
}
