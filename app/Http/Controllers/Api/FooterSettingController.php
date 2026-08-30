<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\JsonResponse;

class FooterSettingController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(): JsonResponse
    {
        $footer = FooterSetting::query()
            ->active()
            ->latest('updated_at')
            ->first();

        return response()->json([
            'success' => true,

            'data' => $footer
                ? [
                    'brand_title' =>
                        $footer->brand_title,

                    'brand_url' =>
                        $footer->brand_url,

                    'description' =>
                        $footer->description,

                    'button_text' =>
                        $footer->button_text,

                    'button_url' =>
                        $footer->button_url,

                    'link_columns' =>
                        $footer->link_columns
                            ?? [],

                    'office_title' =>
                        $footer->office_title,

                    'address' =>
                        $footer->address,

                    'phone' =>
                        $footer->phone,

                    'email' =>
                        $footer->email,

                    'copyright_text' =>
                        $footer->copyright_text,

                    'locations_text' =>
                        $footer->locations_text,
                ]
                : null,
        ]);
    }
}