<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_jobs', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('department')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('location')->nullable();
            $table->string('experience')->nullable();

            $table->text('summary')->nullable();
            $table->longText('description')->nullable();

            $table->json('responsibilities')->nullable();
            $table->json('requirements')->nullable();

            $table->date('deadline');

            $table->string('status')->default('draft');
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index([
                'status',
                'deadline',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_jobs');
    }
};