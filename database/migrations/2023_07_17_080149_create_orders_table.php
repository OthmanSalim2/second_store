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
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('billing_firstName');
            $table->string('billing_lastName');
            $table->string('billing_email');
            $table->string('billing_phone');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_postalCode');
            $table->char('billing_country', 2);
            $table->string('shipping_firstName')->nullable();
            $table->string('shipping_lastName')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_postalCode')->nullable();
            $table->char('shipping_country', 2)->nullable();

            $table->unsignedFloat('tax')->default(0);
            $table->unsignedFloat('discount')->default(0);
            $table->unsignedFloat('total')->default(0);

            $table->enum('status', ['pending', 'processing', 'cancelled', 'shipped', 'delivered']);
            $table->enum('payment_status', ['pending', 'paid', 'failed']);
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
