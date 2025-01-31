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
            $table->decimal('weight', 8, 2);
            $table->unsignedInteger('region');
            $table->json('delivery_hours');
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->timestamp('assign_time')->nullable(); 
            $table->timestamp('complete_time')->nullable();
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
