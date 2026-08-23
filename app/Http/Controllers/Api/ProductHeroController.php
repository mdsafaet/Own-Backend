<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductHero;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductHeroController extends Controller
{
    public function show(): JsonResponse
    {
        $hero = ProductHero::query()
            ->where('is_active', true)
            ->latest('id')
            ->first();

        if (!$hero) {
            return response()->json([
                'success' => true,
                'data' => null,
            ]);
        }

        return response()->json([
            'success' => true,

            'data' => [
                'id' => $hero->id,
                'eyebrow' => $hero->eyebrow,
                'title' => $hero->title,
                'highlighted_title' => $hero->highlighted_title,
                'description' => $hero->description,

                'background_image' => $hero->background_image
                    ? url(
                        Storage::disk('public')->url(
                            $hero->background_image
                        )
                    )
                    : null,

                'image_alt' => $hero->image_alt,

                'primary_button_text' =>
                    $hero->primary_button_text,

                'primary_button_url' =>
                    $hero->primary_button_url,

                'secondary_button_text' =>
                    $hero->secondary_button_text,

                'secondary_button_url' =>
                    $hero->secondary_button_url,
            ],
        ]);
    }
}