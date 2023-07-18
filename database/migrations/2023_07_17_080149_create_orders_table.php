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
            $table->string('number')->unique();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('billing_firstName');
            $table->string('billing_lastName');
            $table->string('billing_email');
            $table->string('billing_phone');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_postalCode');
            $table->string('billing_country');
            $table->string('shipping_firstName');
            $table->string('shipping_lastName');
            $table->string('shipping_email');
            $table->string('shipping_phone');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_postalCode');
            $table->string('shipping_country');

            $table->unsignedFloat('tax')->default(0);
            $table->unsignedFloat('discount')->default(0);
            $table->unsignedFloat('total')->default(0);

            // this's user store the status of order
            $table->enum('status', ['pending', 'processing', 'cancelled', 'shipped', 'delivered'])->default('pending');
            $table->enum('payment_status', ['pending', 'failing', 'paid']);
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
