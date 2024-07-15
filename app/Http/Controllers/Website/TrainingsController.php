<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingsController extends Controller
{
    public function index()
    {
        $training = Training::first();

        return view('website.trainings')->with('training', $training);
    }
}
