<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePricing extends Model
{
    use HasFactory;

    protected $fillable = ['service_type_id', 'price', 'currency'];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}