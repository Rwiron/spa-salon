<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDeal extends Model
{
    use HasFactory;

    protected $table = 'appointment_deals'; // Define the table if it's not the default name
    protected $fillable = ['name', 'email', 'phone', 'service_id', 'servicetype_id', 'date', 'time']; // Add 'phone' to fillable

    // Define relationships with services and service types
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'servicetype_id');
    }
}