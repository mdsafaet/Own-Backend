<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EqwoolsProductApplication extends Model
{
    protected $fillable = [
        'category',
        'description',
        'image',
        'image_alt',
        'products',
        'fabrics',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'products' => 'array',
            'fabrics' => 'array',
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