<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (Testimonial $testimonial): array {
                return [
                    'id' => $testimonial->id,
                    'name' => $testimonial->name,
                    'company' => $testimonial->company,
                    'designation' => $testimonial->designation,
                    'feedback' => $testimonial->feedback,
                    'rating' => $testimonial->rating,

                    'image' => $testimonial->image
                        ? url(
                            Storage::disk('public')->url(
                                $testimonial->image
                            )
                        )
                        : null,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $testimonials,
        ]);
    }
}