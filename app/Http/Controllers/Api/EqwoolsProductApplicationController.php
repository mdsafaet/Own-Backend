<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EqwoolsProductApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class EqwoolsProductApplicationController extends Controller
{
    public function index(): JsonResponse
    {
        $applications =
            EqwoolsProductApplication::query()
                ->active()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(function (
                    EqwoolsProductApplication $application
                ): array {
                    return [
                        'id' =>
                            $application->id,

                        'category' =>
                            $application->category,

                        'description' =>
                            $application->description,

                        'image_alt' =>
                            $application->image_alt,

                        'image_url' =>
                            $application->image
                                ? url(
                                    Storage::disk(
                                        'public'
                                    )->url(
                                        $application->image
                                    )
                                )
                                : null,

                        'products' =>
                            $application->products
                                ?? [],

                        'fabrics' =>
                            $application->fabrics
                                ?? [],
                    ];
                });

        return response()->json([
            'success' => true,
            'data' => $applications,
        ]);
    }
}