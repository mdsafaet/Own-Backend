<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buyer_inquiries', function (Blueprint $table) {
            $table->id();

            $table->string('company_name');
            $table->string('contact_person');
            $table->string('email');
            $table->string('country');

            $table->string('product_code')->nullable();
            $table->unsignedInteger('estimated_quantity')->nullable();
            $table->string('target_price')->nullable();
            $table->date('target_delivery_date')->nullable();

            $table->string('attachment')->nullable();
            $table->text('message');

            $table->string('status')->default('new');
            $table->text('internal_notes')->nullable();

            $table->timestamp('contacted_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('product_code');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buyer_inquiries');
    }
};