<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class LeaderController extends Controller
{
    public function index(): JsonResponse
    {
        $leaders = Leader::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (Leader $leader) {
                $paragraphs = [];

                if (filled($leader->message)) {
                    $paragraphs = preg_split(
                        '/\R\s*\R/',
                        trim($leader->message)
                    );

                    $paragraphs = array_values(
                        array_filter(
                            array_map('trim', $paragraphs)
                        )
                    );
                }

                return [
                    'id' => $leader->id,
                    'name' => $leader->name,
                    'role' => $leader->role,
                    'label' => $leader->label,
                    'experience' => $leader->experience,
                    'preview' => $leader->preview,
                    'paragraphs' => $paragraphs,

                    'image' => $leader->image
                        ? url(
                            Storage::disk('public')
                                ->url($leader->image)
                        )
                        : null,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $leaders,
        ]);
    }
}