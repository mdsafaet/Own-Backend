<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EqwoolsHero;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class EqwoolsHeroController extends Controller
{
    public function show(): JsonResponse
    {
        $hero = EqwoolsHero::query()
            ->active()
            ->latest('updated_at')
            ->first();

        return response()->json([
            'success' => true,

            'data' => [
                'eyebrow' =>
                    $hero?->eyebrow,

                'title' =>
                    $hero?->title,

                'highlighted_title' =>
                    $hero?->highlighted_title,

                'description' =>
                    $hero?->description,

                'image_alt' =>
                    $hero?->image_alt,

                'background_image_url' =>
                    $hero?->background_image
                        ? url(
                            Storage::disk(
                                'public'
                            )->url(
                                $hero->background_image
                            )
                        )
                        : null,

                'button_text' =>
                    $hero?->button_text,

                'button_url' =>
                    $hero?->button_url,
            ],
        ]);
    }
}