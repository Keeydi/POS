<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
            $table->foreignId('staff_id')->nullable()->constrained()->onDelete('set null'); // For commissionable items
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->text('modifiers')->nullable(); // JSON or text
            $table->text('special_instructions')->nullable();
            $table->enum('department_status', ['pending', 'in_progress', 'ready', 'served'])->default('pending');
            $table->boolean('is_voided')->default(false);
            $table->text('void_reason')->nullable();
            $table->foreignId('voided_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('voided_at')->nullable();
            $table->timestamps();
            
            $table->index(['order_id', 'product_id', 'staff_id']);
            $table->index(['order_id', 'department_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
