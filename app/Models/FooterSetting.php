<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'brand_title',
        'brand_url',
        'description',
        'button_text',
        'button_url',
        'link_columns',
        'office_title',
        'address',
        'phone',
        'email',
        'copyright_text',
        'locations_text',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'link_columns' => 'array',
            'is_active' => 'boolean',
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