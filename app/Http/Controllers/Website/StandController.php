<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\StandCar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\PrettyPrinter\Standard;

class StandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $models = CarModel::all();

        $now = Carbon::now();
        $year = $now->year;
        $amount = 100;
        $years = [];
        for ($i = $year; $i > $year - $amount; --$i) {
            $years[] = $i;
        }

        return view('website.stand')->with([
            'brands' => $brands,
            'models' => $models,
            'years' => $years,
        ]);
    }

    public function car(Request $request)
    {
        $car = StandCar::with([
            'brand',
            'car_model',
            'fuel',
            'month',
            'origin',
            'status'
        ])
            ->where('id', $request->id)
            ->first();
        return view('website.stand_car')->with('car', $car);
    }
}