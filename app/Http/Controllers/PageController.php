<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('front.about');
    }

    public function services()
    {
        return view('front.services');
    }

    public function enquire()
    {
        return view('front.enquire');
    }
}
