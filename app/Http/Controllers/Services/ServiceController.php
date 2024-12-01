<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServicePricing;

class ServiceController extends Controller
{
    // Show all services
    public function index()
    {
        $services = Service::with('serviceTypes.pricing')->get();
        return view('admin.services.index', compact('services'));
    }

    // Show form to create a new service
    public function create()
    {
        return view('admin.services.create');
    }

    // Store a new service
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    // Edit a service
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Update a service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    // Delete a service
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}