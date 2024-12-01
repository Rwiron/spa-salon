<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;  // Keep the model as 'Service'
use App\Models\ServiceType;
use App\Models\ServicePricing;

class FacilityController extends Controller
{
    // Show all facilities (services)
    public function index()
    {
        $facilities = Service::with('serviceTypes.pricing')->get();  // Service remains unchanged
        return view('admin.facilities.index', compact('facilities'));  // Update the view name
    }

    // Show form to create a new facility (service)
    public function create()
    {
        return view('admin.facilities.create');  // Update the view name
    }

    // Store a new facility (service)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility = Service::create([  // Service model remains unchanged
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('facilities.index')->with('success', 'Facility created successfully.');
    }

    // Edit a facility (service)
    public function edit(Service $facility)
    {
        return view('admin.facilities.edit', compact('facility'));  // Update the view name
    }

    // Update a facility (service)
    public function update(Request $request, Service $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully.');
    }

    // Delete a facility (service)
    public function destroy(Service $facility)
    {
        $facility->delete();
        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully.');
    }
}