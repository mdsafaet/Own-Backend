<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('showroom_products', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('product_code')->unique();

            $table->string('category')->nullable();
            $table->string('status')->default('in_development');

            $table->text('short_description')->nullable();

            $table->string('image')->nullable();
            $table->json('gallery')->nullable();

            $table->string('fabric')->nullable();
            $table->string('composition')->nullable();
            $table->string('gsm')->nullable();

            $table->string('moq')->nullable();
            $table->string('sample_lead_time')->nullable();
            $table->string('production_lead_time')->nullable();

            $table->json('features')->nullable();
            $table->json('available_colours')->nullable();

            $table->boolean('sustainable')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index([
                'is_active',
                'category',
                'status',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('showroom_products');
    }
};