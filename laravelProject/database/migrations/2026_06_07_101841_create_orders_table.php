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

            // The customer who placed the order. If their account is later
            // deleted we keep the order but null the link (set null).
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            // Billing / shipping details captured at checkout.
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('address');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();

            // Money snapshot at the time of ordering.
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('shipping_price', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            $table->string('shipping_method')->default('Free Shipping');
            $table->string('payment_method')->default('Cash / Bank Transfer');

            // Order lifecycle. Admin moves it through these states.
            $table->enum('status', [
                'New',
                'Accepted',
                'Cancelled',
                'Onshipping',
                'Completed',
            ])->default('New');

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
