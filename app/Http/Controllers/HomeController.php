<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       /*  $a = Person::leftJoin('attendences' , 'people.id' , 'attendences.person_id')->get()->groupBy('person_id');


        dd($a); */


        return view('dashboard/pages/home/index');
    }
}
