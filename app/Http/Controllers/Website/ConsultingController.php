<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Consulting;
use Illuminate\Http\Request;

class ConsultingController extends Controller
{
    public function index()
    {
        $consulting = Consulting::first();

        return view('website.consulting')->with('consulting', $consulting);

    }
}