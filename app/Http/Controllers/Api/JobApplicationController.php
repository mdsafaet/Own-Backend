<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class JobApplicationController
    extends Controller
{
    /**
     * Submit an application for a vacancy.
     */
    public function store(
        Request $request,
        Job $job
    ): JsonResponse {
        /*
         * Check the vacancy status and deadline before
         * validating or storing the CV.
         */
        if (!$job->isAcceptingApplications()) {
            return response()->json([
                'success' => false,
                'message' =>
                    'The application deadline has passed. This vacancy is no longer accepting CV submissions.',
            ], 422);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:150',
                ],

                'phone' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'current_company' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'current_position' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'cover_letter' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],

                'cv' => [
                    'required',
                    'file',
                    'mimes:pdf,doc,docx',
                    'max:5120',
                ],
            ],
            [
                'name.required' =>
                    'Please enter your full name.',

                'email.required' =>
                    'Please enter your email address.',

                'email.email' =>
                    'Please enter a valid email address.',

                'cv.required' =>
                    'Please upload your CV.',

                'cv.mimes' =>
                    'The CV must be a PDF, DOC or DOCX file.',

                'cv.max' =>
                    'The CV must not be larger than 5MB.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' =>
                    'Please correct the highlighted fields.',
                'errors' =>
                    $validator->errors(),
            ], 422);
        }

        /*
         * Check the deadline again because it may have passed
         * while the applicant was completing the form.
         */
        $job->refresh();

        if (!$job->isAcceptingApplications()) {
            return response()->json([
                'success' => false,
                'message' =>
                    'The application deadline has passed. Your CV was not submitted.',
            ], 422);
        }

        $validated = $validator->validated();
        $cvPath = null;

        try {
            /*
             * CVs are stored on Laravel's private local disk,
             * not inside public/storage.
             */
            $cvPath = $request
                ->file('cv')
                ->store(
                    'job-applications/cvs',
                    'local'
                );

            $application = $job
                ->applications()
                ->create([
                    'name' =>
                        $validated['name'],

                    'email' =>
                        $validated['email'],

                    'phone' =>
                        $validated['phone']
                            ?? null,

                    'current_company' =>
                        $validated[
                            'current_company'
                        ] ?? null,

                    'current_position' =>
                        $validated[
                            'current_position'
                        ] ?? null,

                    'cover_letter' =>
                        $validated[
                            'cover_letter'
                        ] ?? null,

                    'cv_path' =>
                        $cvPath,

                    'status' =>
                        'new',
                ]);

            return response()->json([
                'success' => true,
                'message' =>
                    'Your application has been submitted successfully.',

                'data' => [
                    'id' =>
                        $application->id,

                    'job_title' =>
                        $job->title,

                    'submitted_at' =>
                        $application
                            ->created_at
                            ->toISOString(),
                ],
            ], 201);
        } catch (Throwable $exception) {
            /*
             * Remove the uploaded CV if database creation
             * fails after the file was stored.
             */
            if (
                filled($cvPath) &&
                Storage::disk('local')
                    ->exists($cvPath)
            ) {
                Storage::disk('local')
                    ->delete($cvPath);
            }

            report($exception);

            return response()->json([
                'success' => false,
                'message' =>
                    'We could not submit your application. Please try again.',
            ], 500);
        }
    }
}