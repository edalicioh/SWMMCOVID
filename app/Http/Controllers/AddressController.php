<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\StoreUpdade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();

        return view('dashboard/pages/address/create' , compact(['cities' , 'states']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request, $isNew = false)
    {

        $address = new Address();
        $address->street = $request->street;
        $address->number = $request->number;
        $address->observation = $request->observation;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->district_id = $request->district_id;
        $address->save();
        return $address->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {

        $address->street        = $request->street;
        $address->number        = $request->number;
        $address->observation   = $request->observation;
        $address->state_id      = $request->state_id;
        $address->city_id       = $request->city_id;
        $address->district_id   = $request->district_id;
        $address->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
