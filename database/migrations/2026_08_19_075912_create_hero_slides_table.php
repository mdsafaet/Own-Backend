<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();

            $table->string('image');

            $table->string('alt')->nullable();

            $table->string('eyebrow')->nullable();

            $table->string('title')->nullable();

            $table->string('highlighted_title')
                ->nullable();

            $table->text('description')->nullable();

            $table->string('primary_button_label')
                ->nullable();

            $table->string('primary_button_link')
                ->nullable();

            $table->string('secondary_button_label')
                ->nullable();

            $table->string('secondary_button_link')
                ->nullable();

            $table->string('position')
                ->default('left');

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};