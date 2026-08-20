<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index(): JsonResponse
    {
        $slides = HeroSlide::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (
                HeroSlide $slide
            ): array {
                return [
                    'id' => $slide->id,

                    'image' => url(
                        Storage::disk('public')
                            ->url($slide->image)
                    ),

                    'alt' => $slide->alt,

                    'eyebrow' =>
                        $slide->eyebrow,

                    'title' =>
                        $slide->title,

                    'highlightedTitle' =>
                        $slide->highlighted_title,

                    'description' =>
                        $slide->description,

                    'primaryButton' => [
                        'label' =>
                            $slide
                                ->primary_button_label,

                        'link' =>
                            $slide
                                ->primary_button_link,
                    ],

                    'secondaryButton' => [
                        'label' =>
                            $slide
                                ->secondary_button_label,

                        'link' =>
                            $slide
                                ->secondary_button_link,
                    ],

                    'position' =>
                        $slide->position,

                    'sortOrder' =>
                        $slide->sort_order,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $slides,
        ]);
    }
}