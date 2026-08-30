<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'contact_offices',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->string('country');

                $table
                    ->string('title')
                    ->nullable();

                $table
                    ->string('company')
                    ->nullable();

                $table
                    ->string('person')
                    ->nullable();

                $table
                    ->string('designation')
                    ->nullable();

                $table
                    ->json('address_lines')
                    ->nullable();

                $table
                    ->string('phone')
                    ->nullable();

                $table
                    ->string('mobile')
                    ->nullable();

                $table
                    ->string('whatsapp')
                    ->nullable();

                $table
                    ->string('email')
                    ->nullable();

                $table
                    ->string('icon')
                    ->default('globe');

                $table
                    ->boolean('featured')
                    ->default(false);

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
            'contact_offices'
        );
    }
};