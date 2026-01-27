<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->enum('payment_method', ['Cash', 'Card', 'GCash', 'Other']);
            $table->decimal('amount', 10, 2);
            $table->string('reference')->nullable(); // For card/GCash transactions
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // Cashier
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['order_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
