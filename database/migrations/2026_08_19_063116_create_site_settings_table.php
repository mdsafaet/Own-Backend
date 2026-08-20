<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_title')
                ->default('Own Sourcing');

            $table->string('site_subtitle')
                ->nullable()
                ->default('International');

            $table->string('logo')
                ->nullable();

            $table->string('logo_alt')
                ->nullable()
                ->default('Own Sourcing International');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};