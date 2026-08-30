<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'garment_accessory_categories',
            function (Blueprint $table) {
                $table->id();

                $table->string('title');

                $table
                    ->text('description')
                    ->nullable();

                $table
                    ->string('image')
                    ->nullable();

                $table
                    ->string('image_alt')
                    ->nullable();

                $table
                    ->string('icon')
                    ->nullable();

                $table
                    ->json('products')
                    ->nullable();

                $table
                    ->boolean('is_active')
                    ->default(true);

                $table
                    ->unsignedInteger('sort_order')
                    ->default(0);

                $table->timestamps();

                $table->index([
                    'is_active',
                    'sort_order',
                ]);
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'garment_accessory_categories'
        );
    }
};