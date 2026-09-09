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
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (
                HeroSlide $slide
            ): array {
                return [
                    'id' => $slide->id,

                    'image' => $slide->image
                        ? url(
                            Storage::disk('public')
                                ->url($slide->image)
                        )
                        : null,

                    'alt' => $slide->alt,
                    'eyebrow' => $slide->eyebrow,
                    'title' => $slide->title,

                    /*
                     * The new carousel can use either
                     * highlightedTitle or subtitle.
                     */
                    'highlightedTitle' =>
                        $slide->highlighted_title,

                    'subtitle' =>
                        $slide->description,

                    'description' =>
                        $slide->description,

                    'linkLabel' =>
                        $slide->primary_button_label,

                    'link' =>
                        $slide->primary_button_link,

                    'primaryButton' => [
                        'label' =>
                            $slide->primary_button_label,

                        'link' =>
                            $slide->primary_button_link,
                    ],

                    'secondaryButton' => [
                        'label' =>
                            $slide->secondary_button_label,

                        'link' =>
                            $slide->secondary_button_link,
                    ],

                    'position' =>
                        $slide->position ?? 'center',

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