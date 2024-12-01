<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        // Fetch all team members from the database
        $teams = Team::all();

        // Pass the data to the view
        return view('pages.team', compact('teams'));
    }
}