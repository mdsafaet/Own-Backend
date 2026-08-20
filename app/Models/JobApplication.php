<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'current_company',
        'current_position',
        'cover_letter',
        'cv_path',
        'status',
    ];

    protected static function booted(): void
    {
        static::deleting(function (
            JobApplication $application
        ): void {
            if (
                filled($application->cv_path) &&
                Storage::disk('local')->exists(
                    $application->cv_path
                )
            ) {
                Storage::disk('local')->delete(
                    $application->cv_path
                );
            }
        });
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(
            Job::class,
            'job_id'
        );
    }
}