<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    public function provideTypes()
    {
        return $this->hasMany(ProvideType::class);
    }
}