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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->string('transaction_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['pending', 'success', 'failed', 'expired']);
            $table->string('midtrans_snap_token')->nullable();
            $table->string('midtrans_booking_code')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
