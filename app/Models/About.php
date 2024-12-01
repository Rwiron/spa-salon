<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'spa_specialists_count',
        'happy_clients_count',
        'image_path'
    ];
}