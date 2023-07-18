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
        Schema::create('notifications', function (Blueprint $table) {
            // uuid -> universal unique id this's make generate id and unique
            $table->uuid('id')->primary();
            // it's use to determine type of notification amd this's represent name of notification class
            $table->string('type');
            /* two columns notifiable_id, notifiable_type and notifiable_type possible store inside it for user or admin
            notifiable_id it's represent id of user
            */
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
