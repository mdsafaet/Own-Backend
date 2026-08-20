<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function show(): JsonResponse
    {
        $settings = SiteSetting::query()->first();

        return response()->json([
            'success' => true,

            'data' => [
                'site_title' =>
                    $settings?->site_title
                    ?? 'Own Sourcing',

                'site_subtitle' =>
                    $settings?->site_subtitle
                    ?? 'International',

                'logo_alt' =>
                    $settings?->logo_alt
                    ?? 'Own Sourcing International',

                'logo_url' =>
                    $settings?->logo
                        ? url(
                            Storage::disk('public')
                                ->url($settings->logo)
                        )
                        : null,
            ],
        ]);
    }
}