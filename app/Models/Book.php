<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public const CATEGORIES = ['Novel', 'Teknologi', 'Sejarah'];

    protected $fillable = [
        'title',
        'author',
        'category',
        'published_at',
        'stock',
        'is_available',
        'synopsis',
        'isbn',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'stock' => 'integer',
            'is_available' => 'boolean',
        ];
    }
}
