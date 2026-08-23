<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FactoryPartner;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class FactoryPartnerController extends Controller
{
    public function index(): JsonResponse
    {
        $factories = FactoryPartner::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (FactoryPartner $factory) {
                return [
                    'id' => $factory->id,
                    'name' => $factory->name,
                    'category' => $factory->category,
                    'specialization' =>
                        $factory->specialization,
                    'compliance' => $factory->compliance,
                    'leed' => $factory->leed,
                    'capacity' => $factory->capacity,

                    'profile' => $factory->profile
                        ? url(
                            Storage::disk('public')->url(
                                $factory->profile
                            )
                        )
                        : null,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $factories,
        ]);
    }
}