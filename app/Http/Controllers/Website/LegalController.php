<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Legal;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function index(Request $request)
    {

        $legal = Legal::find($request->id);

        return view('website.legal')->with('legal', $legal);
    }
}
