<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;
use App\Models\Service;

class ServiceTypeController extends Controller
{
    // Display all service types
    public function index()
    {
        $serviceTypes = ServiceType::with('service')->get(); // Fetch service types with related services
        return view('admin.service_types.index', compact('serviceTypes')); // Return the view with service types
    }

    // Show form to create a new service type
    public function create()
    {
        $services = Service::all(); // Fetch all services for the dropdown
        return view('admin.service_types.create', compact('services'));
    }

    // Store a newly created service type
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
        ]);

        ServiceType::create([
            'name' => $request->name,
            'service_id' => $request->service_id,
            'price' => $request->price,
        ]);

        return redirect()->route('service_types.index')->with('success', 'Service Type created successfully.');
    }


    // Show form to edit a service type
    public function edit(ServiceType $serviceType)
    {
        $services = Service::all(); // Fetch all services for the dropdown
        return view('admin.service_types.edit', compact('serviceType', 'services'));
    }

    // Update a service type

    public function update(Request $request, ServiceType $serviceType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
        ]);

        $serviceType->update([
            'name' => $request->name,
            'service_id' => $request->service_id,
            'price' => $request->price,
        ]);

        return redirect()->route('service_types.index')->with('success', 'Service Type updated successfully.');
    }

    // Delete a service type
    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return redirect()->route('service_types.index')->with('success', 'Service Type deleted successfully.');
    }
}