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
        Schema::create('scale_operations', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_plate');
            $table->string('driver_name')->nullable();
            $table->string('material_type')->nullable();
            $table->decimal('gross_weight', 10, 2)->default(0);
            $table->decimal('tare_weight', 10, 2)->default(0);
            $table->decimal('net_weight', 10, 2)->storedAs('gross_weight - tare_weight');
            $table->decimal('fee', 10, 2)->default(0);
            $table->string('status')->default('unpaid');
            $table->boolean('is_live')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scale_operations');
    }
};
