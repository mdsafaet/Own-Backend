<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GarmentAccessoryCategory extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'image_alt',
        'icon',
        'products',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'products' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(
        Builder $query
    ): Builder {
        return $query->where(
            'is_active',
            true
        );
    }
}