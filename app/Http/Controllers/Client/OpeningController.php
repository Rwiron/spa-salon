<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\OpenHour;  // Import the OpenHour model

class OpeningController extends Controller
{
    public function index()
    {
        // Fetch the open hours data from the database
        $openHours = OpenHour::first();

        // Pass the data to the view
        return view('pages.opening', compact('openHours'));
    }
}