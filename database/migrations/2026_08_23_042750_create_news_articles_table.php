<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'cms_news_articles',
            function (Blueprint $table) {
                $table->id();

                $table->string('title');
                $table->string('slug')->unique();

                $table->string('content_type')
                    ->default('internal');

                $table->string('category')
                    ->nullable();

                $table->string('author')
                    ->nullable();

                $table->string('source_name')
                    ->nullable();

                $table->text('excerpt')
                    ->nullable();

                $table->longText('content')
                    ->nullable();

                $table->string('image')
                    ->nullable();

                $table->string('external_url')
                    ->nullable();

                $table->string('read_time')
                    ->nullable();

                $table->dateTime('published_at')
                    ->nullable();

                $table->string('status')
                    ->default('draft');

                $table->boolean('featured')
                    ->default(false);

                $table->unsignedInteger('sort_order')
                    ->default(0);

                $table->timestamps();

                $table->index([
                    'status',
                    'published_at',
                ]);
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'cms_news_articles'
        );
    }
};