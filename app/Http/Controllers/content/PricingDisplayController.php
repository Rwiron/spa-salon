<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;

class PricingDisplayController extends Controller
{
    public function index()
    {
        // Fetch all pricing plans along with their features
        $pricingPlans = PricingPlan::with('features')->get();

        return view('client.pricing.index', compact('pricingPlans'));
    }

    public function show($id)
    {
        // Fetch the pricing plan with the given ID along with its features
        $pricingPlan = PricingPlan::with('features')->findOrFail($id);

        return view('client.pricing.show', compact('pricingPlan'));
    }
}
