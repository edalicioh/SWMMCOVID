<?php

namespace App\Http\Controllers;

use App\Models\CollectionLocation;
use App\Models\Contamination;
use Illuminate\Http\Request;

class ContaminationController extends Controller
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
        $contamination = Contamination::create($request->all());

        return $contamination->id;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contamination  $contamination
     * @return \Illuminate\Http\Response
     */
    public function show(Contamination $contamination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contamination  $contamination
     * @return \Illuminate\Http\Response
     */
    public function edit(Contamination $contamination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contamination  $contamination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contamination $contamination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contamination  $contamination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contamination $contamination)
    {
        //
    }
}
