<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactOffice;
use Illuminate\Http\JsonResponse;

class ContactOfficeController extends Controller
{
    public function index(): JsonResponse
    {
        $offices =
            ContactOffice::query()
                ->active()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(function (
                    ContactOffice $office
                ): array {
                    $phoneLink =
                        $office->phone
                            ? 'tel:'.preg_replace(
                                '/[^\d+]/',
                                '',
                                $office->phone
                            )
                            : null;

                    $mobileLink =
                        $office->mobile
                            ? 'tel:'.preg_replace(
                                '/[^\d+]/',
                                '',
                                $office->mobile
                            )
                            : null;

                    $whatsappLink =
                        $office->whatsapp
                            ? 'https://wa.me/'.
                                preg_replace(
                                    '/\D/',
                                    '',
                                    $office->whatsapp
                                )
                            : null;

                    return [
                        'id' =>
                            $office->id,

                        'country' =>
                            $office->country,

                        'title' =>
                            $office->title,

                        'company' =>
                            $office->company,

                        'person' =>
                            $office->person,

                        'designation' =>
                            $office->designation,

                        'address' =>
                            $office->address_lines
                                ?? [],

                        'phone' =>
                            $office->phone,

                        'phone_link' =>
                            $phoneLink,

                        'mobile' =>
                            $office->mobile,

                        'mobile_link' =>
                            $mobileLink,

                        'whatsapp' =>
                            $whatsappLink,

                        'email' =>
                            $office->email,

                        'icon' =>
                            $office->icon,

                        'featured' =>
                            (bool)
                            $office->featured,
                    ];
                });

        return response()->json([
            'success' => true,
            'data' => $offices,
        ]);
    }
}