<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create()
    {
        $symptom = Symptom::all();
        $disease = Disease::all();

        return view('dashboard/pages/quiz/create', compact(['disease', 'symptom']));
    }
}
