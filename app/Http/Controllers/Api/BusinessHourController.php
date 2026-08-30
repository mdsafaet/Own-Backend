<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessHour;
use Illuminate\Http\JsonResponse;

class BusinessHourController extends Controller
{
    public function show(): JsonResponse
    {
        $businessHour = BusinessHour::query()
            ->where('is_active', true)
            ->first();

        if (! $businessHour) {
            return response()->json([
                'success' => true,
                'data' => null,
            ]);
        }

        $phoneLink = $businessHour->phone
            ? '+' . preg_replace('/\D+/', '', $businessHour->phone)
            : null;

        return response()->json([
            'success' => true,

            'data' => [
                'id' => $businessHour->id,
                'eyebrow' => $businessHour->eyebrow,
                'working_days' => $businessHour->working_days,
                'working_hours' => $businessHour->working_hours,
                'timezone' => $businessHour->timezone,
                'phone' => $businessHour->phone,
                'phone_link' => $phoneLink,
                'button_text' => $businessHour->button_text,
            ],
        ]);
    }
}