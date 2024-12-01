<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\PricingFeature;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    // Display all pricing plans
    public function index()
    {
        $pricingPlans = PricingPlan::all();
        return view('admin.content.pricing.index', compact('pricingPlans'));
    }

    // Show form to create a new pricing plan
    public function create()
    {
        $features = PricingFeature::all();
        return view('admin.content.pricing.create', compact('features'));
    }

    // Store the new pricing plan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'features' => 'array', // Expecting an array of feature IDs
        ]);

        $pricingPlan = PricingPlan::create([
            'title' => $request->title,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        // Attach features to the pricing plan
        if ($request->has('features')) {
            $pricingPlan->features()->attach($request->features);
        }

        return redirect()->route('pricingplan.index')->with('success', 'Pricing Plan created successfully.');
    }

    // Show the form to edit a pricing plan
    public function edit($id)
    {
        $pricingPlan = PricingPlan::findOrFail($id);
        $features = PricingFeature::all();
        return view('admin.content.pricing.edit', compact('pricingPlan', 'features'));
    }

    // Update the pricing plan
    public function update(Request $request, $id)
    {
        $pricingPlan = PricingPlan::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'features' => 'array',  // Validate that features is an array
            'features.*' => 'exists:pricing_features,id',  // Validate that each feature exists
        ]);

        // Update pricing plan details
        $pricingPlan->update([
            'title' => $request->title,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        // Sync features
        $pricingPlan->features()->sync($request->features);  // Sync the selected features

        return redirect()->route('pricingplan.index')->with('success', 'Pricing plan updated successfully.');
    }

    // Delete a pricing plan
    public function destroy($id)
    {
        $pricingPlan = PricingPlan::findOrFail($id);
        $pricingPlan->delete();
        return redirect()->route('pricingplan.index')->with('success', 'Pricing Plan deleted successfully.');
    }
}