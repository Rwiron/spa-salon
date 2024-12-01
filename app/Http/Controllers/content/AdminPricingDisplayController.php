<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;

class AdminPricingDisplayController extends Controller
{
    public function index()
    {
        // Fetch all pricing plans along with their features using pivot table
        $pricingPlans = PricingPlan::with('features')->get();

        // Pass the pricing plans with features to the view
        return view('admin.content.pricing.index', compact('pricingPlans'));
    }

    public function show($id)
    {
        // Fetch the specific pricing plan along with its features
        $pricingPlan = PricingPlan::with('features')->findOrFail($id);

        // Pass the individual plan to the view for detailed display
        return view('admin.content.pricing.show', compact('pricingPlan'));
    }
}