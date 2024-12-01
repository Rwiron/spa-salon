<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time',
        'service_id',
        'servicetype_id',
    ];

    // Relationship to Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Relationship to Service Type
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'servicetype_id');
    }
}