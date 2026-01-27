<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payout_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payout_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_item_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('commission_rule_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('quantity')->default(0);
            $table->decimal('unit_commission', 10, 2);
            $table->decimal('total_commission', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index(['payout_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payout_items');
    }
};
