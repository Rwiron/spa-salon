<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicePricing;
use App\Models\Service;  // Fetch service
use App\Models\ServiceType;

class ServicePricingController extends Controller
{
    // Show all pricing records
    public function index()
    {
        $pricings = ServicePricing::with('serviceType.service')->get();  // Fetch related services via service types
        $services = Service::all();  // Fetch all services for the dropdown in the modal

        return view('admin.pricing.index', compact('pricings', 'services')); // Pass services to view
    }

    // Store new pricing for a service type
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',  // Ensure valid service
            'price' => 'required|numeric|min:0',
        ]);

        ServicePricing::create([
            'service_type_id' => $request->service_id,  // Store service ID
            'price' => $request->price,
        ]);

        return redirect()->route('pricing.index')->with('success', 'Pricing added successfully.');
    }

    // Show form to edit pricing
    public function edit(ServicePricing $pricing)
    {
        $services = Service::all();  // Fetch all services for editing
        return view('admin.pricing.edit', compact('pricing', 'services'));
    }

    // Update pricing for a service
    public function update(Request $request, ServicePricing $pricing)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
        ]);

        $pricing->update([
            'service_type_id' => $request->service_id,  // Update service ID
            'price' => $request->price,
        ]);

        return redirect()->route('pricing.index')->with('success', 'Pricing updated successfully.');
    }

    // Delete pricing
    public function destroy(ServicePricing $pricing)
    {
        $pricing->delete();

        return redirect()->route('pricing.index')->with('success', 'Pricing deleted successfully.');
    }
}