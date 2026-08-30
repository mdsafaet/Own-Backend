<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'eqwools_heroes',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->string('eyebrow')
                    ->nullable();

                $table
                    ->string('title')
                    ->nullable();

                $table
                    ->string('highlighted_title')
                    ->nullable();

                $table
                    ->text('description')
                    ->nullable();

                $table
                    ->string('background_image')
                    ->nullable();

                $table
                    ->string('image_alt')
                    ->nullable();

                $table
                    ->string('button_text')
                    ->nullable();

                $table
                    ->string('button_url')
                    ->nullable();

                $table
                    ->boolean('is_active')
                    ->default(true);

                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'eqwools_heroes'
        );
    }
};