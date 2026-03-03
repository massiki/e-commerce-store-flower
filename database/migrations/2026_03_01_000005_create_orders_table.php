<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->text('notes')->nullable();
            $table->text('greeting_card')->nullable();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->string('status')->default('pending'); // pending, paid, processing, shipped, delivered, cancelled, expired
            $table->string('snap_token')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
