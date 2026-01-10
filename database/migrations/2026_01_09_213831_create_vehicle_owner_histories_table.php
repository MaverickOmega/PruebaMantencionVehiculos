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
        Schema::create('vehicle_owner_histories', function (Blueprint $table) {
            $table->id();
            // Vehículo asociado
            $table->foreignId('vehicle_id')
                ->constrained()
                ->restrictOnDelete();

            // Usuario asociado
            $table->foreignId('user_id')
                ->constrained()
                ->restrictOnDelete();

            // Periodo de posesión.
            $table->timestamp('assigned_at');                    // Desde cuando es dueño del vehículo
            $table->timestamp('unassigned_at')->nullable();      // Hasta cuando es dueño del vehículo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_owner_histories');
    }
};
