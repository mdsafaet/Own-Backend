<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactoryHero extends Model
{
    protected $fillable = [
        'eyebrow',
        'title',
        'highlighted_title',
        'description',
        'background_image',
        'image_alt',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'trust_items',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'trust_items' => 'array',
            'is_active' => 'boolean',
        ];
    }
}