<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->text('address')->nullable();
            $table->string('contact')->nullable();
            $table->text('receipt_footer_note')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('service_charge_rate', 5, 2)->default(0);
            $table->enum('service_charge_mode', ['percent', 'fixed'])->default('percent');
            $table->decimal('service_charge_fixed', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
