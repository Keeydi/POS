<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commission_rules', function (Blueprint $table) {
            $table->id();
            $table->string('rule_name');
            $table->json('staff_type_applicability')->nullable(); // Array of staff types
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('commission_model', ['per_item_fixed', 'percentage_of_sales', 'tiered_by_quantity']);
            $table->decimal('value', 10, 2)->nullable(); // For fixed or percentage
            $table->json('tiers')->nullable(); // For tiered commissions: [{"min": 1, "max": 10, "value": 40}, ...]
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            $table->index(['active', 'valid_from', 'valid_to']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_rules');
    }
};
