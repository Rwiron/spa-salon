<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\Tariff;

class PriceController extends Controller
{
    public function index()
    {
        // Fetch all pricing plans with their associated features
        $pricingPlans = PricingPlan::with('features')->get();

        // Fetch all available tariffs
        $tariffs = Tariff::all();

        // Pass pricing plans to the view
        return view('pages.price', compact('pricingPlans','tariffs'));
    }
}