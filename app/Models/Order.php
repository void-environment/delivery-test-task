<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'region',
        'delivery_hours',
        'courier_id',
        'assign_time',
        'complete_time'
    ];

    protected $casts = [
        'delivery_hours' => 'array',
        'assign_time' => 'datetime',
        'complete_time' => 'datetime',
    ];
}
