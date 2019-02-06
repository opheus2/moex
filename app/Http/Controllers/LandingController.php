<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    //

    public function index()
    {        
        return view('layouts.landing');
    }

    public function privacy()
    {        
        return view('landing.privacy');
    }

    public function contact()
    {        
        return view('landing.contact');
    }

    public function test()
    {        
        return view('layouts.landing');
    }
}
