<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class FacilityServiceController extends Controller
{
    // Display all services with their service types
    // public function index()
    // {
    //     // Paginate the services, retrieving 5 per page
    //     $services = Service::with('serviceTypes')->paginate(5);

    //     return view('admin.facilities.services', compact('services'));
    // }
    public function index()
    {
        $services = Service::with('serviceTypes')->paginate(5); // Paginate services
        return view('admin.facilities.services', compact('services'));
    }


}