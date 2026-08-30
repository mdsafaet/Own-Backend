<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'footer_settings',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->string('brand_title')
                    ->nullable();

                $table
                    ->string('brand_url')
                    ->nullable();

                $table
                    ->text('description')
                    ->nullable();

                $table
                    ->string('button_text')
                    ->nullable();

                $table
                    ->string('button_url')
                    ->nullable();

                $table
                    ->json('link_columns')
                    ->nullable();

                $table
                    ->string('office_title')
                    ->nullable();

                $table
                    ->text('address')
                    ->nullable();

                $table
                    ->string('phone')
                    ->nullable();

                $table
                    ->string('email')
                    ->nullable();

                $table
                    ->string('copyright_text')
                    ->nullable();

                $table
                    ->string('locations_text')
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
            'footer_settings'
        );
    }
};