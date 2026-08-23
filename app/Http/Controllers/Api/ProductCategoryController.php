<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = ProductCategory::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (ProductCategory $category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'subtitle' => $category->subtitle,

                    'image' => $category->image
                        ? url(Storage::disk('public')->url($category->image))
                        : null,

                    'products' => $category->products ?? [],
                    'collections' => $category->collections ?? [],
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }
}