<?php

namespace App\Http\Controllers;

use App\Models\CollectionLocation;
use App\Models\State;
use Illuminate\Http\Request;

class CollectionLocationController extends Controller
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
        $states = State::all();
        return view('dashboard/pages/collection/create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $addressId = (new AddressController())->store($request);
            $all = $request->all();
            $all['address_id'] = $addressId;
            CollectionLocation::create($all);
            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/person');
        } catch (\Exception $e) {
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectionLocation  $collectionLocation
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionLocation $collectionLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CollectionLocation  $collectionLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(CollectionLocation $collectionLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CollectionLocation  $collectionLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectionLocation $collectionLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectionLocation  $collectionLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionLocation $collectionLocation)
    {
        //
    }
}
