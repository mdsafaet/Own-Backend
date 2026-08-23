<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsArticle extends Model
{
    protected $table = 'cms_news_articles';

    protected $fillable = [
        'title',
        'slug',
        'content_type',
        'category',
        'author',
        'source_name',
        'excerpt',
        'content',
        'image',
        'external_url',
        'read_time',
        'published_at',
        'status',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (
            NewsArticle $article
        ): void {
            $article->slug =
                static::generateUniqueSlug(
                    $article->title
                );

            static::prepareArticle($article);
        });

        static::updating(function (
            NewsArticle $article
        ): void {
            if ($article->isDirty('title')) {
                $article->slug =
                    static::generateUniqueSlug(
                        $article->title,
                        $article->id
                    );
            }

            static::prepareArticle($article);
        });
    }

    private static function prepareArticle(
        NewsArticle $article
    ): void {
        if (
            $article->status === 'published' &&
            blank($article->published_at)
        ) {
            $article->published_at = now();
        }

        if (
            $article->content_type === 'internal'
        ) {
            $article->external_url = null;
            $article->source_name = null;
        }

        if (
            $article->content_type === 'external'
        ) {
            $article->content = null;
        }
    }

    private static function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($title);

        if (blank($baseSlug)) {
            $baseSlug = 'article';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            static::query()
                ->where('slug', $slug)
                ->when(
                    $ignoreId !== null,
                    fn ($query) =>
                        $query->where(
                            'id',
                            '!=',
                            $ignoreId
                        )
                )
                ->exists()
        ) {
            $slug =
                $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    public function isPublished(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at->lte(now());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}