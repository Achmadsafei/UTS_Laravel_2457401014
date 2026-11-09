<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public const TYPES = ['Standar', 'Deluxe', 'Premium'];

    protected $fillable = [
        'room_number',
        'room_type',
        'floor',
        'monthly_price',
        'capacity',
        'is_available',
        'facilities',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'floor' => 'integer',
            'monthly_price' => 'integer',
            'capacity' => 'integer',
            'is_available' => 'boolean',
        ];
    }
}
