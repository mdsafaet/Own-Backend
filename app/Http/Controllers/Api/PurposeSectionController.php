<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurposeSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PurposeSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $purposeSection =
            PurposeSection::query()->first();

        return response()->json([
            'success' => true,

            'data' => [
                'image_url' =>
                    $purposeSection?->image
                        ? url(
                            Storage::disk('public')
                                ->url(
                                    $purposeSection->image
                                )
                        )
                        : null,

                'image_alt' =>
                    $purposeSection?->image_alt,

                'experience_value' =>
                    $purposeSection
                        ?->experience_value,

                'experience_label' =>
                    $purposeSection
                        ?->experience_label,
            ],
        ]);
    }
}