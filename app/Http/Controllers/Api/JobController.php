<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    /**
     * Return all currently published vacancies.
     */
    public function index(): JsonResponse
    {
        $jobs = Job::query()
            ->where('status', 'open')
            ->whereDate(
                'deadline',
                '>=',
                today()
            )
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(
                fn (Job $job): array =>
                    $this->transformJob($job)
            );

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ]);
    }

    /**
     * Return featured vacancies for the homepage.
     */
    public function featured(): JsonResponse
    {
        $jobs = Job::query()
            ->where('status', 'open')
            ->where('featured', true)
            ->whereDate(
                'deadline',
                '>=',
                today()
            )
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(2)
            ->get()
            ->map(
                fn (Job $job): array =>
                    $this->transformJob($job)
            );

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ]);
    }

    /**
     * Return one vacancy using its slug.
     */
    public function show(Job $job): JsonResponse
    {
        if ($job->status === 'draft') {
            abort(404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->transformJob($job),
        ]);
    }

    /**
     * Format the job response.
     */
    private function transformJob(
        Job $job
    ): array {
        return [
            'id' => $job->id,
            'title' => $job->title,
            'slug' => $job->slug,

            'department' =>
                $job->department,

            'type' =>
                $job->employment_type,

            'employment_type' =>
                $job->employment_type,

            'location' =>
                $job->location,

            'experience' =>
                $job->experience,

            'summary' =>
                $job->summary,

            'description' =>
                $job->description,

            'responsibilities' =>
                $job->responsibilities ?? [],

            'requirements' =>
                $job->requirements ?? [],

            'deadline' =>
                $job->deadline?->format(
                    'Y-m-d'
                ),

            'formatted_deadline' =>
                $job->deadline?->format(
                    'd F Y'
                ),

            'status' =>
                $job->status,

            'featured' =>
                (bool) $job->featured,

            'application_open' =>
                $job->isAcceptingApplications(),

            'created_at' =>
                $job->created_at?->toISOString(),

            'updated_at' =>
                $job->updated_at?->toISOString(),
        ];
    }
}