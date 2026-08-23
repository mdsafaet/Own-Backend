<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factory_partners', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('category');

            $table->text('specialization')->nullable();

            $table->boolean('compliance')->default(false);

            $table->string('leed')->nullable();
            $table->string('capacity')->nullable();
            $table->string('profile')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index([
                'is_active',
                'sort_order',
            ]);

            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factory_partners');
    }
};