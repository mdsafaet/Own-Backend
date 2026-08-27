<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buyer_inquiries', function (Blueprint $table) {
            $table->string('inquiry_type')
                ->default('product_inquiry')
                ->after('id');

            $table->string('product_category')
                ->nullable()
                ->after('product_code');

            $table->string('required_standard')
                ->nullable()
                ->after('product_category');

            $table->string('target_market')
                ->nullable()
                ->after('required_standard');
        });
    }

    public function down(): void
    {
        Schema::table('buyer_inquiries', function (Blueprint $table) {
            $table->dropColumn([
                'inquiry_type',
                'product_category',
                'required_standard',
                'target_market',
            ]);
        });
    }
};