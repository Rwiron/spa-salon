<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Provide;

class ProvidingController extends Controller
{
    // Show the list of all services
    public function index()
    {
        $provides = Provide::all(); // Fetch all the provide services
        return view('client.provide.index', compact('provides')); // Return the list view
    }

    // Show detailed view for a specific service
    public function show($id)
    {
        $provide = Provide::findOrFail($id); // Find the provide item by ID
        return view('client.provide.show', compact('provide')); // Return the detailed view
    }
}