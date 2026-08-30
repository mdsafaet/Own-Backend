<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_hours', function (Blueprint $table) {
            $table->id();

            $table->string('eyebrow')->nullable();
            $table->string('working_days')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('timezone')->nullable();

            $table->string('phone')->nullable();
            $table->string('button_text')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_hours');
    }
};