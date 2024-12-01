<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'carousel_text_1',
        'carousel_text_2',
        'carousel_text_3',
        'carousel_image_1',
        'carousel_image_2',
        'carousel_image_3',
        'about_us_title',
        'about_us_description',
        'about_us_image',
        'service_title',
        'service_subtitle',
        'contact_email',
        'contact_phone',
    ];
}