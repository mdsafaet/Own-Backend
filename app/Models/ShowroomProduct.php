<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShowroomProduct extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'product_code',
        'category',
        'status',
        'short_description',
        'image',
        'gallery',
        'fabric',
        'composition',
        'gsm',
        'moq',
        'sample_lead_time',
        'production_lead_time',
        'features',
        'available_colours',
        'sustainable',
        'featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'features' => 'array',
            'available_colours' => 'array',
            'sustainable' => 'boolean',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ShowroomProduct $product): void {
            if (blank($product->slug)) {
                $product->slug = static::createUniqueSlug(
                    $product->title
                );
            }
        });

        static::updating(function (ShowroomProduct $product): void {
            if (
                blank($product->slug) ||
                (
                    $product->isDirty('title') &&
                    !$product->isDirty('slug')
                )
            ) {
                $product->slug = static::createUniqueSlug(
                    $product->title,
                    $product->id
                );
            }
        });
    }

    private static function createUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($title);

        if ($baseSlug === '') {
            $baseSlug = 'showroom-product';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            static::query()
                ->when(
                    $ignoreId,
                    fn ($query) => $query->whereKeyNot($ignoreId)
                )
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}