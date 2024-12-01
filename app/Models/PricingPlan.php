<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'duration',
    ];

    // Relationship: A PricingPlan has many PricingFeatures
    public function features()
    {
        return $this->belongsToMany(PricingFeature::class, 'pricing_plan_feature', 'pricing_plan_id', 'feature_id');
    }

}