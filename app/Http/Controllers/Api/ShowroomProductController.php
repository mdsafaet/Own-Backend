<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShowroomProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShowroomProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $products = ShowroomProduct::query()
            ->where('is_active', true)
            ->when(
                $request->filled('category') &&
                $request->string('category')->toString()
                    !== 'All',
                fn ($query) => $query->where(
                    'category',
                    $request
                        ->string('category')
                        ->toString()
                )
            )
            ->when(
                $request->filled('status') &&
                $request->string('status')->toString()
                    !== 'All',
                fn ($query) => $query->where(
                    'status',
                    $request
                        ->string('status')
                        ->toString()
                )
            )
            ->when(
                $request->boolean('sustainable'),
                fn ($query) => $query->where(
                    'sustainable',
                    true
                )
            )
            ->when(
                $request->filled('search'),
                function ($query) use ($request): void {
                    $search = trim(
                        $request
                            ->string('search')
                            ->toString()
                    );

                    $query->where(
                        function ($query) use (
                            $search
                        ): void {
                            $query
                                ->where(
                                    'title',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'product_code',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'category',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'fabric',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'composition',
                                    'like',
                                    "%{$search}%"
                                );
                        }
                    );
                }
            )
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get()
            ->map(
                fn (ShowroomProduct $product): array =>
                    $this->transform($product)
            );

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function show(
        string $slug
    ): JsonResponse {
        $product = ShowroomProduct::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $this->transform($product),
        ]);
    }

    private function transform(
        ShowroomProduct $product
    ): array {
        return [
            'id' => $product->id,
            'title' => $product->title,
            'slug' => $product->slug,
            'code' => $product->product_code,
            'category' => $product->category,

            'status' => $product->status,

            'status_label' => match (
                $product->status
            ) {
                'new_arrival' =>
                    'New Arrival',

                'ready_for_sampling' =>
                    'Ready for Sampling',

                'in_development' =>
                    'In Development',

                default =>
                    $product->status,
            },

            'description' =>
                $product->short_description,

            'image' => $product->image
                ? url(
                    Storage::disk('public')->url(
                        $product->image
                    )
                )
                : null,

            'gallery' => collect(
                $product->gallery ?? []
            )
                ->map(
                    fn (string $image): string =>
                        url(
                            Storage::disk('public')
                                ->url($image)
                        )
                )
                ->values()
                ->all(),

            'fabric' => $product->fabric,
            'composition' => $product->composition,
            'gsm' => $product->gsm,
            'moq' => $product->moq,

            'sample_lead_time' =>
                $product->sample_lead_time,

            'production_lead_time' =>
                $product->production_lead_time,

            'features' =>
                $product->features ?? [],

            'available_colours' =>
                $product->available_colours ?? [],

            'sustainable' =>
                $product->sustainable,

            'featured' =>
                $product->featured,
        ];
    }
}