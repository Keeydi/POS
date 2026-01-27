<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->date('payout_date');
            $table->foreignId('shift_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('allowance', 10, 2)->default(0);
            $table->decimal('commission', 10, 2)->default(0);
            $table->decimal('adjustments', 10, 2)->default(0); // Positive or negative
            $table->decimal('deductions', 10, 2)->default(0);
            $table->decimal('net_payout', 10, 2);
            $table->text('adjustment_reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['draft', 'finalized', 'paid'])->default('draft');
            $table->timestamp('finalized_at')->nullable();
            $table->timestamp('printed_at')->nullable();
            $table->timestamps();
            
            $table->index(['payout_date', 'staff_id']);
            $table->index(['staff_id', 'payout_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
