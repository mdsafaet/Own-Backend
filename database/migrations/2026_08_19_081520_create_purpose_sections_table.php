<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purpose_sections', function (
            Blueprint $table
        ) {
            $table->id();

            $table->string('image')
                ->nullable();

            $table->string('image_alt')
                ->nullable();

            $table->string('experience_value')
                ->nullable();

            $table->string('experience_label')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purpose_sections');
    }
};