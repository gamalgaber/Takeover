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
            $table->string('invoice_id');
            $table->integer('user_id');
            $table->double('total');
            $table->integer('product_quantity');
            $table->string('payment_method');
            $table->integer('payment_status');
            $table->text('order_address');
            $table->text('coupon')->nullable();
            $table->text('shipping_price');
            $table->string('order_status');
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
