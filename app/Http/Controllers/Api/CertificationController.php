<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function index(): JsonResponse
    {
        $certifications = Certification::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(
                fn (
                    Certification $certification
                ): array => [
                    'id' => $certification->id,

                    'title' =>
                        $certification->title,

                    'logo_alt' =>
                        $certification->logo_alt,

                    'logo_url' =>
                        $certification->logo
                            ? url(
                                Storage::disk('public')
                                    ->url(
                                        $certification->logo
                                    )
                            )
                            : null,

                    'website_url' =>
                        $certification->website_url,
                ]
            );

        return response()->json([
            'success' => true,
            'data' => $certifications,
        ]);
    }
}