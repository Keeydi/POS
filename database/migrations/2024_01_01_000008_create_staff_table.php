<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_code')->unique();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->enum('staff_type', ['Model', 'Host', 'Waitress', 'Bartender', 'Kitchen']);
            $table->decimal('default_allowance', 10, 2)->default(0);
            $table->unsignedBigInteger('default_commission_profile_id')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['staff_type', 'active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
