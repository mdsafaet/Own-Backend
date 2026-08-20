<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_id')
                ->constrained('career_jobs')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();

            $table->string('current_company')->nullable();
            $table->string('current_position')->nullable();

            $table->text('cover_letter')->nullable();
            $table->string('cv_path');

            $table->string('status')->default('new');

            $table->timestamps();

            $table->index([
                'job_id',
                'status',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};