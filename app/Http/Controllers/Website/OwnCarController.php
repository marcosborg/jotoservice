<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\OwnCar;
use Illuminate\Http\Request;

class OwnCarController extends Controller
{
    public function index()
    {

        $ownCar = OwnCar::first();

        return view('website.own_car')->with('ownCar', $ownCar);
    }
}