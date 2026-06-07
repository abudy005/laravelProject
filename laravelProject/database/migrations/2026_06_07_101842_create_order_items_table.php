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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Each line item belongs to an order; delete items with the order.
            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');

            // Link to the product, but keep the line if the product is later
            // deleted (we still stored its title/price below as a snapshot).
            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            // Snapshot of the product at purchase time (so historical orders
            // don't change if the product is edited or removed later).
            $table->string('product_title');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
