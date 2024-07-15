<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\StandCar;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function car(Request $request)
    {
        return Car::find($request->car_id);
    }

    public function standCars(Request $request)
    {
        $standCars = StandCar::with([
            'fuel',
            'month',
            'origin',
            'status',
            'brand',
            'car_model'
        ])
            ->paginate(5);

        return view('partials.stand_cars')->with('stand_cars', $standCars);
    }
}