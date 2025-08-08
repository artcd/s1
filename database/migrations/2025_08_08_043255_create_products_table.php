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
            $table->id()->comment('id');
            $table->string('name')->comment('product name');
            $table->text('description')->nullable()->default(null)->comment('product description');
            $table->decimal('price')->index('price')->comment('product price');
            $table->integer('stock_quantity')->index('stock_quantity')->comment('product stock quantity');
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
