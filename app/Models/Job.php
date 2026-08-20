<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Job extends Model
{
    protected $table = 'career_jobs';

    protected $fillable = [
        'title',
        'slug',
        'department',
        'employment_type',
        'location',
        'experience',
        'summary',
        'description',
        'responsibilities',
        'requirements',
        'deadline',
        'status',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'responsibilities' => 'array',
            'requirements' => 'array',
            'deadline' => 'date',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Job $job): void {
            if (
                blank($job->slug) ||
                $job->isDirty('title')
            ) {
                $baseSlug = Str::slug($job->title);
                $slug = $baseSlug;
                $counter = 1;

                while (
                    static::query()
                        ->where('slug', $slug)
                        ->when(
                            $job->exists,
                            fn ($query) =>
                                $query->where(
                                    'id',
                                    '!=',
                                    $job->id
                                )
                        )
                        ->exists()
                ) {
                    $slug =
                        $baseSlug . '-' . $counter++;
                }

                $job->slug = $slug;
            }
        });

        static::deleting(function (Job $job): void {
            $job->applications()
                ->get()
                ->each
                ->delete();
        });
    }

    public function applications(): HasMany
    {
        return $this->hasMany(
            JobApplication::class,
            'job_id'
        );
    }

    public function isAcceptingApplications(): bool
    {
        return $this->status === 'open'
            && $this->deadline !== null
            && now()->lte(
                $this->deadline
                    ->copy()
                    ->endOfDay()
            );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}