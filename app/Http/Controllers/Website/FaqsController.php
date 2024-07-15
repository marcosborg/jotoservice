<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {

        $faqs = FaqQuestion::all();

        return view('website.faqs')->with('faqs', $faqs);
    }
}
