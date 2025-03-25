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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->BLOB('product_image');
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity');
            $table->date('expire_date')->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('final_price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('sold')->default(false);
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
