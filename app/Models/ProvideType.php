<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvideType extends Model
{
    use HasFactory;

    protected $fillable = [
        'provide_id',
        'type_name',
        'description',
        'price',
    ];

    public function provide()
    {
        return $this->belongsTo(Provide::class);
    }
}