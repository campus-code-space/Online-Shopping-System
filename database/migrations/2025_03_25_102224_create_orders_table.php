<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_price', 10, 2);
            $table->string('status')->nullable(); // pending, paid, shipped, delivered, canceled
            $table->string('delivery_status')->nullable(); // pending, out_for_delivery, delivered
            $table->date('delivery_date')->nullable();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subscription_id')->nullable()->constrained('subscriptions')->onDelete('cascade');
            $table->foreignId('delivery_agent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
