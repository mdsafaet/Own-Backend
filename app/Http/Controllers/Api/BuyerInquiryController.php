<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuyerInquiryRequest;
use App\Models\BuyerInquiry;
use Illuminate\Http\JsonResponse;

class BuyerInquiryController extends Controller
{
    public function store(
        StoreBuyerInquiryRequest $request
    ): JsonResponse {
        $validated = $request->validated();

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request
                ->file('attachment')
                ->store(
                    'buyer-inquiries/attachments',
                    'public'
                );
        }

        $inquiry = BuyerInquiry::query()->create([
            'company_name' =>
                $validated['company_name'],

            'contact_person' =>
                $validated['contact_person'],

            'email' =>
                $validated['email'],

            'country' =>
                $validated['country'],

            'product_code' =>
                $validated['product_code'] ?? null,

            'estimated_quantity' =>
                $validated['estimated_quantity'] ?? null,

            'target_price' =>
                $validated['target_price'] ?? null,

            'target_delivery_date' =>
                $validated['target_delivery_date'] ?? null,

            'attachment' => $attachmentPath,

            'message' => $validated['message'],

            'status' => 'new',

            'ip_address' => $request->ip(),

            'user_agent' => str(
                $request->userAgent() ?? ''
            )->limit(1000)->toString(),
        ]);

        return response()->json([
            'success' => true,

            'message' =>
                'Your inquiry has been submitted successfully.',

            'data' => [
                'id' => $inquiry->id,
                'reference' => sprintf(
                    'BI-%06d',
                    $inquiry->id
                ),
            ],
        ], 201);
    }
}