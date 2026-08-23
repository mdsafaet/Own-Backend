<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class NewsArticleController extends Controller
{
    /**
     * Return all published news articles.
     */
    public function index(): JsonResponse
    {
        $articles = NewsArticle::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where(
                'published_at',
                '<=',
                now()
            )
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->get()
            ->map(
                fn (
                    NewsArticle $article
                ): array =>
                    $this->transformArticle(
                        $article,
                        false
                    )
            );

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }

    /**
     * Return articles featured on the homepage.
     */
    public function featured(): JsonResponse
    {
        $articles = NewsArticle::query()
            ->where('status', 'published')
            ->where('featured', true)
            ->whereNotNull('published_at')
            ->where(
                'published_at',
                '<=',
                now()
            )
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get()
            ->map(
                fn (
                    NewsArticle $article
                ): array =>
                    $this->transformArticle(
                        $article,
                        false
                    )
            );

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }

    /**
     * Return one published article using its slug.
     */
    public function show(
        NewsArticle $newsArticle
    ): JsonResponse {
        if (!$newsArticle->isPublished()) {
            return response()->json([
                'success' => false,
                'message' =>
                    'The requested article was not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' =>
                $this->transformArticle(
                    $newsArticle,
                    true
                ),
        ]);
    }

    /**
     * Convert an article into an API response.
     */
    private function transformArticle(
        NewsArticle $article,
        bool $includeContent
    ): array {
        return [
            'id' => $article->id,

            'title' => $article->title,

            'slug' => $article->slug,

            'content_type' =>
                $article->content_type,

            'category' =>
                $article->category,

            'author' =>
                $article->author,

            'source_name' =>
                $article->source_name,

            'excerpt' =>
                $article->excerpt,

            /*
             * Full content is returned only on the details API.
             */
            'content' =>
                $includeContent
                    ? $article->content
                    : null,

            /*
             * Convert the stored image path into a complete URL.
             */
            'image' =>
                $article->image
                    ? url(
                        Storage::disk('public')
                            ->url($article->image)
                    )
                    : null,

            'external_url' =>
                $article->external_url,

            'read_time' =>
                $article->read_time,

            'published_at' =>
                $article->published_at
                    ?->toISOString(),

            'formatted_date' =>
                $article->published_at
                    ?->format('d F Y'),

            'featured' =>
                (bool) $article->featured,

            /*
             * This helps React determine which link to use.
             */
            'article_url' =>
                $article->content_type
                    === 'external'
                && filled(
                    $article->external_url
                )
                    ? $article->external_url
                    : '/news/' .
                        $article->slug,

            'opens_new_tab' =>
                $article->content_type
                    === 'external',
        ];
    }
}