<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = ['courier_type', 'regions', 'working_hours'];

    protected $casts = [
        'regions' => 'array',
        'working_hours' => 'array',
    ];
}
