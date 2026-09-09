<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('alt')->nullable()->change();
            $table->string('eyebrow')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('highlighted_title')->nullable()->change();
            $table->text('description')->nullable()->change();

            $table->string('primary_button_label')
                ->nullable()
                ->change();

            $table->string('primary_button_link', 500)
                ->nullable()
                ->change();

            $table->string('secondary_button_label')
                ->nullable()
                ->change();

            $table->string('secondary_button_link', 500)
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            /*
             * Do not make these fields required again because existing
             * records may contain null values.
             */
        });
    }
};