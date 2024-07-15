<?php

namespace App\Http\Controllers\website;


use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\HeroBanner;
use App\Models\HomeInfo;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {

        //HERO
        $hero = HeroBanner::first();
        //INFO
        $info = HomeInfo::first();
        //Activities
        $activities = Activity::all();
        //Testimonials
        $testimonials = Testimonial::all();

        return view('website.home')->with([
            'hero' => $hero,
            'info' => $info,
            'activities' => $activities,
            'testimonials' => $testimonials
        ]);
    }
}