<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FactoryPartner extends Model
{
    protected $fillable = [
        'name',
        'category',
        'specialization',
        'compliance',
        'leed',
        'capacity',
        'profile',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'compliance' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}