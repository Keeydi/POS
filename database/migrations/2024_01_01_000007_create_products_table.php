<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->string('sku')->unique();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->decimal('cost', 10, 2)->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_commissionable')->default(false);
            $table->enum('commission_type', ['fixed', 'percentage', 'tiered'])->nullable();
            $table->decimal('commission_value', 10, 2)->nullable();
            $table->json('commission_tiers')->nullable(); // For tiered commissions
            $table->boolean('taxable')->default(true);
            $table->boolean('active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['category_id', 'active']);
            $table->index(['department_id', 'active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
