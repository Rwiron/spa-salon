<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\PricingFeature;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingFeatureController extends Controller
{
    // Display all pricing features
    public function index()
    {
        // Eager load the pricing plan and paginate results
        $features = PricingFeature::with('pricingPlan')->paginate(perPage: 10); // Display 10 items per page

        return view('admin.content.features.index', compact('features'));
    }


    // Show form to create a new feature
    public function create()
    {
        $pricingPlans = PricingPlan::all();
        return view('admin.content.features.create', compact('pricingPlans'));
    }

    // Store the new feature
    public function store(Request $request)
    {
        $request->validate([
            'feature' => 'required|string|max:255',
            'pricing_plan_id' => 'required|exists:pricing_plans,id', // Ensure pricing_plan_id is valid
        ]);

        PricingFeature::create([
            'feature' => $request->feature,
            'pricing_plan_id' => $request->pricing_plan_id,  // Associate the feature with the pricing plan
        ]);

        return redirect()->route('pricingfeatures.index')->with('success', 'Feature created successfully.');
    }

    // Show form to edit a feature
    public function edit($id)
    {
        $feature = PricingFeature::findOrFail($id);
        $pricingPlans = PricingPlan::all(); // Fetch all pricing plans for the dropdown
        return view('admin.content.features.edit', compact('feature', 'pricingPlans'));
    }


    // Update the feature
    public function update(Request $request, $id)
    {
        $request->validate([
            'feature' => 'required|string|max:255',
            'pricing_plan_id' => 'required|exists:pricing_plans,id', // Ensure pricing_plan_id is valid
        ]);

        $feature = PricingFeature::findOrFail($id);
        $feature->update([
            'feature' => $request->feature,
            'pricing_plan_id' => $request->pricing_plan_id,  // Update the associated pricing plan
        ]);

        return redirect()->route('pricingfeatures.index')->with('success', 'Feature updated successfully.');
    }

    // Delete a feature
    public function destroy($id)
    {
        $feature = PricingFeature::findOrFail($id);
        $feature->delete();
        return redirect()->route('pricingfeatures.index')->with('success', 'Feature deleted successfully.');
    }
}