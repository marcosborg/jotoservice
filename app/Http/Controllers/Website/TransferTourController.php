<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\TransferTour;
use Illuminate\Http\Request;

class TransferTourController extends Controller
{
    public function index()
    {
        $transfer_tours = TransferTour::all();

        return view('website.transfer_tours')->with('transfer_tours', $transfer_tours);
    }

    public function transferTour(Request $request)
    {
        $transferTour = TransferTour::find($request->id);
        return view('website.transfer_tour')->with('transferTour', $transferTour);
    }
}