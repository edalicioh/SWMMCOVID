<?php

namespace App\Http\Controllers;

use App\Models\CollectionLocation;
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
        //
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
            $request->address_id = (new AddressController())->store($request);
            CollectionLocation::create($request->all());
            return CollectionLocation::all();
        } catch (\Exception $e) {
           return false;
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
