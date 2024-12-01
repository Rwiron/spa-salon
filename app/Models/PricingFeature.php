<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingFeature extends Model
{
    use HasFactory;

    protected $fillable = ['feature', 'pricing_plan_id'];

    // Define the relationship between PricingFeature and PricingPlan
    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class, 'pricing_plan_id');
    }
}