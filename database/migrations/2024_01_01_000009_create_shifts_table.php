<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->date('shift_date');
            $table->time('shift_open')->nullable();
            $table->time('shift_close')->nullable();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->boolean('attendance_met')->default(false); // For allowance eligibility
            $table->timestamps();
            
            $table->index(['staff_id', 'shift_date']);
            $table->index(['shift_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
