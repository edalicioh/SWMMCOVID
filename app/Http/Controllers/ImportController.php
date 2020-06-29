<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class ImportController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/pages/import/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $symptms = Symptom::all();



        foreach ($data as $key => $value) {
            if ($key > 7) {
                $exp = explode(', ', $value[5]);
                foreach ($exp as $Ekey => $e) {
                    foreach ($symptms as $Skey => $symptm) {
                        if($symptm->symptom_description == strtoupper($e)){
                            echo "<br>";
                            echo $key;
                            echo " ";
                            echo  $symptm->symptom_description;
                            echo " ";
                            echo $symptm->id;
                        } else {
                            echo "<br>-- else --<br>";
                            echo $key;
                            echo  strtoupper($e);
                        }
                    }
                }
            }
        }
        die;
    }
}
