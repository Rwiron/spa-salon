<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Team;


class AboutController extends Controller
{
    public function index()
    {

        $about = About::first();
        $teams = Team::all();

        return view('pages.about', compact('about', 'teams'));
        //return view('pages.index', compact('carousels','about'));
    }
}