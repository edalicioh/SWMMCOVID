<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create()
    {
        return view('dashboard/pages/quiz/create' );
    }
}
