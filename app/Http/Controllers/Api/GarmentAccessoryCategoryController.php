<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GarmentAccessoryCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class GarmentAccessoryCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories =
            GarmentAccessoryCategory::query()
                ->active()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(function (
                    GarmentAccessoryCategory $category
                ): array {
                    return [
                        'id' =>
                            $category->id,

                        'title' =>
                            $category->title,

                        'description' =>
                            $category->description,

                        'icon' =>
                            $category->icon,

                        'image_alt' =>
                            $category->image_alt,

                        'image_url' =>
                            $category->image
                                ? url(
                                    Storage::disk(
                                        'public'
                                    )->url(
                                        $category->image
                                    )
                                )
                                : null,

                        'products' =>
                            $category->products
                                ?? [],
                    ];
                });

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }
}