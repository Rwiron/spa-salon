<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_id',
        'price',  // Add the price field here
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function pricing()
    {
        return $this->hasOne(ServicePricing::class);
    }
}